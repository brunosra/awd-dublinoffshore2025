<?php

global $sys_path;

if (empty($sys_path)) {
    throw new Exception("Error: \$sys_path is undefined.", 1);
    exit;
}

require_once($sys_path . '/pdf/vendor/fpdf/fpdf.php');
require_once($sys_path . '/pdf/vendor/fpdi2/autoload.php');

use \setasign\Fpdi\Fpdi;

// Remove generated PDF files from ./temp after $expires hours
global $expires;
$expires = 1;

// Calculator values
global $pdf_texts;
$pdf_texts = [
    "LRD_hei" => [
        "page" => 3,
        "label" => "m",
        "x" => 81,
        "y" => 214.65
    ],
    "T_SWL" => [
        "page" => 3,
        "label" => "m",
        "x" => 81,
        "y" => 219.2
    ],
    "MBL" => [
        "page" => 3,
        "label" => " tonnes",
        "x" => 81,
        "y" => 205.5
    ],
    "X_SWL" => [
        "page" => 3,
        "label" => " tonnes",
        "x" => 81,
        "y" => 210
    ],
    "mooring_decl" => [
        "page" => 3,
        "label" => "deg",
        "x" => 81,
        "y" => 228
    ],
];

// Position/size of images
global $pdf_images;
$pdf_images = [
    "image" => [
        "page" => 3,
        "x" => 12.7,
        "y" => 51,
        "width" => 85,
        "ratio" => floatval(number_format(800 / 600, 4)) // width / height - from original image 
    ],
    "chart" => [
        "page" => 3,
        "x" => 104,
        "y" => 68,
        "width" => 94,
        "ratio" => floatval(number_format(401 / 546, 4)) // width / height - from original image 
    ]
];

clear_cache();

function prepare_and_save() {
    global $sys_path;
    $img = $_POST['svg'] ?? false;
    $chart = $_POST['chart'] ?? false;
    $res = [
        "message" => "SVG not sent",
        "name" => "",
        "url" => ""
    ];
    
    if ($img && $chart) {
        $uid = rand(1000, 9999);
        $pdf_name = "manual-{$uid}.pdf";
        $chart_name = "chart-{$uid}.png";
        $img_name = "img-{$uid}.png";
        
        $chart_a = explode('base64,', $chart);
        $chart_data = base64_decode($chart_a[1]);
        file_put_contents("{$sys_path}/pdf/temp/{$chart_name}", $chart_data);
        
        $img_data = png_from_svg(urldecode($img));
        file_put_contents("{$sys_path}/pdf/temp/{$img_name}", $img_data);

        $pdf = make_pdf($pdf_name, $img_name, $chart_name);
        file_put_contents("{$sys_path}/pdf/temp/{$pdf_name}", $pdf);

        unlink("{$sys_path}/pdf/temp/{$img_name}");
        unlink("{$sys_path}/pdf/temp/{$chart_name}");
    
        $res = [
            "message" => "",
            "name" => $pdf_name,
            "url" => "/pdf/temp/{$pdf_name}"
        ];
    }
    return $res;
}

function img_height($width, $ratio) {
    return floatval(number_format($width * $ratio, 2));
}

function png_from_svg($svg) {
    $im = new Imagick();
    $im->setBackgroundColor(new ImagickPixel('#ffffff'));
    $im->readImageBlob($svg);
    $im->setImageFormat("png");
    $im->setImageDepth(8);
    $png_content = $im->getImageBlob();
    $im->clear();
    $im->destroy();
    return $png_content;
}

function make_pdf($name, $image, $chart, $output_type = 'S') {
    global $pdf_images;
    global $pdf_texts;
    global $sys_path;
    $pdf = new Fpdi();
    $pagesTotal = $pdf->setSourceFile($sys_path . '/pdf/source.pdf');
    for ($page = 1; $page <= $pagesTotal; $page++) {
        $templateId = $pdf->importPage($page);
        $pdf->AddPage();
        $pdf->useTemplate($templateId, ['adjustPageSize' => true]);
        foreach ($pdf_images as $iid => $im) {
            if ($page == $im['page']) {
                $pdf->Image("{$sys_path}/pdf/temp/{$$iid}", $im['x'], $im['y'], $im['width'], img_height($im['width'], $im['ratio']));
            }
        }
        foreach ($pdf_texts as $tid => $txt) {
            if ($page == $txt['page'] && isset($_POST[$tid])) {
                $pdf->SetFont('Arial');
                $pdf->SetFontSize(8);
                $pdf->SetTextColor(50, 50, 50);
                $pdf->SetXY($txt['x'], $txt['y']);
                $pdf->Write(0, "{$_POST[$tid]}{$txt['label']}");
            }
        }

        /* add fixed text – Water Depth Rating */
        if ($page == 3) {
            $pdf->SetFont('Arial');
            $pdf->SetFontSize(8);
            $pdf->SetTextColor(50, 50, 50);
            $pdf->SetXY(81, 223.65);
            $pdf->Write(0, "100m");
            $pdf->SetXY(51, 163.65);
            $pdf->Write(0, "not to scale");
        }
    }
    return $pdf->Output($output_type, $name);
}


function clear_cache() {
    global $expires, $sys_path;
    $files = scandir("{$sys_path}/pdf/temp");
    $now = time();
    foreach ($files as $name) {
        if ($name[0] == '.') continue;
        $limit = filectime("{$sys_path}/pdf/temp/{$name}") + ($expires * 60 * 60);
        if ($now > $limit) {
            unlink("{$sys_path}/pdf/temp/{$name}");
        }
    }
}