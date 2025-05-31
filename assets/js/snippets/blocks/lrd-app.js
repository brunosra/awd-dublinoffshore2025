function LRD_calc(LRD_dia, LRD_hei, axes_horz_dist, axes_vert_dist, mooring_decl) {

  // Constants
  const LRD_des_depth = 100;
  const LRD_vol = Math.PI * (LRD_dia / 2) ** 2 * LRD_hei;
  const ballast_rho = 3500;
  
  // Material properties
  const LRD_mat_Sy = 355;
  const load_factor = 1.35;
  const mat_factor = 1.15;
  const mat_den = 7850;
  const den_water = 1025;
  const g = 9.81;
  const hydro_pres = den_water * g * LRD_des_depth / 1000;
  const tube_wall_t = Math.max(0.01, hydro_pres * load_factor * (LRD_dia / 2) / (LRD_mat_Sy * 1000 / mat_factor));
  const tube_vol = tube_wall_t * 2 * Math.PI * (LRD_dia / 2) * LRD_hei;
  const tube_mass = tube_vol * 7.85; // Assuming density conversion is included in 7.85
  
  // Topcap calculations
  const topcap_Mc2 = (3 + 0.3) / 16 * hydro_pres * 1000 * (LRD_dia / 2) ** 2;
  const topcap_t = Math.min(tube_wall_t * 3, Math.sqrt(topcap_Mc2 * 6 / LRD_mat_Sy) / 1000);
  const topcap_vol = topcap_t * Math.PI * (LRD_dia / 2) ** 2;
  const topcap_mass = topcap_vol * mat_den / 1000;
  
  // Bottom cap calculations
  const botcap_t = tube_wall_t;
  const botcap_vol = botcap_t * Math.PI * (LRD_dia / 2) ** 2;
  const botcap_mass = botcap_vol * mat_den / 1000;
  
  // Scantling
  const scant_ratio = 0.50;
  const scant_vol = (tube_vol + topcap_vol + botcap_vol) * scant_ratio;
  const scant_mass = scant_vol * mat_den / 1000;
  
  // Weight calculations
  const LRD_str_wt = tube_mass + topcap_mass + botcap_mass + scant_mass;
  const LRD_disp = LRD_vol * 1.025;
  const LRD_ballast_wt = LRD_disp - LRD_str_wt;
  const LRD_ballast_vol = 1000 * LRD_ballast_wt / ballast_rho;
  const LRD_ballast_h = LRD_ballast_vol / (Math.PI * (LRD_dia / 2) ** 2);
  const LRD_CoG = -LRD_hei + ((LRD_ballast_wt * (LRD_ballast_h / 2)) + ((tube_mass + scant_mass) * (LRD_hei / 2)) + (topcap_mass * (LRD_hei - topcap_t / 2)) + (botcap_mass * botcap_t / 2)) / (LRD_ballast_wt + LRD_str_wt);
  const LRD_CoB = -LRD_hei / 2;
  
  // Arm geometry
  let arm_length = (Math.sqrt((((LRD_dia / 2) + axes_horz_dist) ** 2) + (((LRD_hei - axes_vert_dist) / 2) ** 2))) * 1.275;

  // Stability calculations
  const x = (LRD_CoB - LRD_CoG) / 2;
  const y = Math.sqrt(axes_horz_dist ** 2 + (axes_vert_dist / 2) ** 2);
  const alpha = Math.atan(axes_horz_dist / (axes_vert_dist / 2)) * 180 / Math.PI;
  
  // piece that disappeared
  const nsize = 200;
  let line_tension = [];
  for (let i = 30; i < nsize + 1; i++) {
    line_tension.push(cutNum(1.05 ** (i - 29), 10));
  }
  line_tension = [
    ...inc(0, 0.009, 0.001), 
    ...inc(0.01, 0.1, 0.01), 
    ...inc(0.2, 1, 0.1), 
    ...line_tension
  ];
  
  let LRD_rotation = [];
  let LRD_extension = [];
  let rotation_row = [];
  let extension_row = [];

  for (let j = 0; j < line_tension.length; j++) {
    LRD_rotation_row = Math.min(180-mooring_decl+alpha, Math.atan(2*line_tension[j]*y*Math.sin((mooring_decl-alpha)*Math.PI/180)/(((LRD_disp-(-LRD_disp))*x-2*line_tension[j]*y*Math.cos((mooring_decl-alpha)*Math.PI/180))))*180/Math.PI)
    if (LRD_rotation_row < 0)
      LRD_rotation_row = 180 + LRD_rotation_row;
    LRD_extension_row = 2 * arm_length - 2*y*Math.cos((LRD_rotation_row + mooring_decl - alpha)*Math.PI/180)
    
    rotation_row.push(LRD_rotation_row)
    extension_row.push(LRD_extension_row)
  }
  
  const erMin = Math.min(...extension_row);
  extension_row = extension_row.map(x => x - erMin)
  LRD_rotation.push(extension_row);
  LRD_extension = extension_row;
  // Calculate slope and other parameters
  let lt2 = [...line_tension];
  lt2.pop();
  let line_tension_diff = arrSub(line_tension.slice(1), lt2);
  let ex2 = [...LRD_extension];
  ex2.pop();
  let LRD_extension_diff = arrSub(LRD_extension.slice(1), ex2);
  let slope = arrDiv(line_tension_diff, LRD_extension_diff);
  
  let min_count = slope.indexOf(Math.min(...slope)); // obtain the index of the minimum value in slope
  let max_count = slope.indexOf(Math.max(...slope)); // Obtain the index of the maximum value in slope
  
  let T_inflx = line_tension[min_count];
  let X_inflx = LRD_extension[min_count];
  let c_inflx =  T_inflx - Math.min(...slope) * X_inflx;
  
  let T_Xmax = line_tension[max_count];
  let X_Xmax = LRD_extension[max_count];
  let c_Xmax =  T_Xmax - Math.max(...slope) * X_Xmax;
  
  let slope_X0 = slope[1];
  let T_X0 = line_tension[1];
  let X_X0 = LRD_extension[1];
  let c_X0 =  T_X0 - slope_X0 * X_X0;

  X_ph1_ph2 = (c_inflx - c_X0) / (slope_X0 - Math.min(...slope));
  T_ph1_ph2 = X_ph1_ph2 * slope_X0 + c_X0;
  slope_ph1_ph2 = 2*(-T_inflx/X_inflx)
  c_ph1_ph2 = T_ph1_ph2-(slope_ph1_ph2*X_ph1_ph2)

  X_ph2_ph3 = (c_inflx - c_Xmax) / (Math.max(...slope) - Math.min(...slope))
  T_ph2_ph3 = X_ph2_ph3 * Math.min(...slope) + c_inflx
  slope_ph2_ph3 = 2*(-T_inflx/X_inflx)
  c_ph2_ph3 = T_ph2_ph3-(slope_ph2_ph3*X_ph2_ph3)

  dist_ph1_ph2 = [];
  dist_ph2_ph3 = [];
  for (let i = 0; i < LRD_extension.length; i++)
  {
    dist_ph1_ph2.push(Math.sqrt((c_ph1_ph2 + slope_ph1_ph2 * LRD_extension[i] - line_tension[i])**2/(slope_ph2_ph3**2+1)))
    dist_ph2_ph3.push(Math.sqrt((c_ph2_ph3 + slope_ph2_ph3 * LRD_extension[i] - line_tension[i])**2/(slope_ph2_ph3**2+1)))
  }

  function argMin(array) {
    return array.map((x, i) => [x, i]).reduce((r, a) => (a[0] < r[0] ? a : r))[1];
  }

  min_counter_1a = argMin(dist_ph1_ph2)
  T_MWL = line_tension[min_counter_1a]
  X_MWL = LRD_extension[min_counter_1a]

  min_counter_1b = argMin(dist_ph2_ph3) + 6;
  let T_SWL = line_tension[min_counter_1b]
  let X_SWL = LRD_extension[min_counter_1b]
  // let X_SWL = linear(T_SWL, line_tension, LRD_extension)

  return [ line_tension, LRD_extension, T_SWL, X_SWL, arm_length ];
}

// Create input sliders
const LRD_dia = document.getElementById('LRD-dia');
const LRD_hei = document.getElementById('LRD-hei');
const axes_horz_dist = document.getElementById('axes-horz-dist');
const axes_vert_dist = document.getElementById('axes-vert-dist');
const mooring_decl = document.getElementById('mooring-decl');

// Create the graph
const graphDiv = document.getElementById('graph');

// Init Values
let [line_tension, LRD_extension, T_SWL, X_SWL, arm_length] = LRD_calc(
  Number(LRD_dia.value),
  Number(LRD_hei.value),
  Number(axes_horz_dist.value),
  Number(axes_vert_dist.value),
  Number(mooring_decl.value)
);

function getLayout(LRD_extension, T_SWL) {
  return {
    title: '',
    xaxis: {
      title: 'Extension (m)',
      range: [0, Math.max(...LRD_extension)]
    },
    yaxis: {
      title: 'Tension (tonnes)',
      range: [0, T_SWL * 2],
    },
    margin: {
      b: 40,
      l: 48,
      r: 20,
      t: 20,
    },
    showlegend: true,
    legend: {
      x: 0.025,
      xanchor: 'left',
      y: 1,
      borderwidth: 0.5
    },
  };
}

function getData(LRD_extension, line_tension, T_SWL, X_SWL) {
  return [
    {
      x: LRD_extension,
      y: line_tension,
      type: 'line',
      name: 'LRD stiffness',
    },
    {
      x: [X_SWL],
      y: [T_SWL],
      type: 'scatter',
      name: 'Safe Working Load',
      marker: {
        size: 14
      }
    },
  ];
}

function getConfig() {
  return {
    staticPlot: true,
    responsive: true,
    modeBarButtonsToRemove: [
      "autoscale", 
      "zoom", 
      "zoomIn", 
      "zoomOut", 
      "pan", 
      "lasso", 
      "select", 
      "resetscale"
    ],
  };
}

const drawPlot = (LRD_dia, LRD_hei, axes_horz_dist, axes_vert_dist, mooring_decl) => {
  // Calculate initial values
  [line_tension, LRD_extension, T_SWL, X_SWL, arm_length] = LRD_calc(
    LRD_dia,
    LRD_hei,
    axes_horz_dist,
    axes_vert_dist,
    mooring_decl
    );
  let data = [];
  let layout = {};
  let buttonsGroup = document.querySelectorAll(".buttons button.primary");
  if (mooring_decl >= Math.atan(2*axes_horz_dist/axes_vert_dist)*360/(2*Math.PI)+2.5) {
    [...buttonsGroup].forEach(button => { button.style.opacity = 1; button.style.cursor = 'pointer'; button.removeAttribute("disabled")});
    data = getData(LRD_extension, line_tension, T_SWL, X_SWL);
    layout = getLayout(LRD_extension, T_SWL);
  } else {
    [...buttonsGroup].forEach(button => { button.style.opacity = 0.5; button.style.cursor = 'not-allowed'; button.setAttribute("disabled", true)});
    data = [
      {
        x: [5],
        y: [5],
        mode: 'text',
        name: 'LRD stiffness',
        text: ['LRD geometry out of bounds.<br>Reduce LRD axes distance from centreline<br>or<br>Increase LRD axes vertical separation distance.'],
      }
    ];
    layout = {
      title: '',
      xaxis: {
        title: 'Extension (m)',
        range: [0, 10]
      },
      yaxis: {
        title: 'Tension (tonnes)',
        range: [0, 10],
      },
      margin: {
        b: 40,
        l: 48,
        r: 20,
        t: 20,
      },
      showlegend: false,
    };
  }
  const config = getConfig();
  Plotly.react(graphDiv, data, layout, config);
  
  setSVGValues({ LRD_dia, LRD_hei, axes_horz_dist, axes_vert_dist, arm_length: arm_length });
}
const initFunc = () => {
  const data = getData(LRD_extension, line_tension, T_SWL, X_SWL);
  const layout = getLayout(LRD_extension, T_SWL);
  const config = getConfig();
  Plotly.newPlot(graphDiv, data, layout, config);

  let sliders = document.querySelectorAll("#sliders input[type=range]");
  let i = 0;
  while (i < sliders.length) {
    document.getElementById(`input-${sliders[i].id}`).value = Number(sliders[i].value).toFixed(2);
    sliders[i++].addEventListener("input", (evt) => {
      document.getElementById(`input-${evt.target.id}`).value = Number(evt.target.value).toFixed(2);
      drawPlot(
        Number(LRD_dia.value),
        Number(LRD_hei.value),
        Number(axes_horz_dist.value),
        Number(axes_vert_dist.value),
        Number(mooring_decl.value)
      );
    });
  }
  setSVGValues({ 
    LRD_dia: LRD_dia.value, 
    LRD_hei: LRD_hei.value, 
    axes_horz_dist: axes_horz_dist.value, 
    axes_vert_dist: axes_vert_dist.value,
    arm_length: arm_length
  });
}

function inc(min, max, step = 1) {
  const s = String(step);
  const precision = /\./.test(s) ? s.split('.')[1].length : 0;
  let arr = [];
  let cur = min - step;
  while (cur < max) {
    cur += step;
    if (precision) {
      cur = cutNum(cur, precision);
    }
    arr.push(cur);
  }
  return arr;
}

function cutNum(n, precision) {
  return parseFloat(n.toFixed(precision));
}

function arrSub(arr1, arr2, precision = 10) {
  let arr = [];
  arr1.forEach((e, i) => arr.push(cutNum(e - arr2[i], precision)));
  return arr;
}

function arrDiv(arr1, arr2, precision = 10) {
  let arr = [];
  arr1.forEach((e, i) => arr.push(cutNum(e / arr2[i], precision)));
  return arr;
}

initFunc();

function unlockCalculator() {
  const email = window.sessionStorage.getItem('user_email');
  if (email) {
    window.sessionStorage.removeItem('user_email');
    window.sessionStorage.setItem('checked_email', email);
  }
  document.querySelector('#identify').style.display = 'none';
  document.querySelector('.calculator-disabled').classList.remove('calculator-disabled');
}

function setSVGValues(obj) {
  for (const id in obj) {
    const elem = document.querySelector(`svg #${id}_svg text`);
    if (elem) {
      elem.innerHTML = Number(obj[id]).toFixed(2);
    }
  }
}

function saveChart() {
  Plotly.toImage(graphDiv, { format: 'png', width: 800, height: 600 }).then(function (dataUrl) {
    downloadFile(dataUrl, 'lrd-chart.png');
  });
}

function saveSvg() {
  const svg = document.querySelector('#img-placeholder svg');
  svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
  const svgData = svg.outerHTML;
  const preface = '<?xml version="1.0" standalone="no"?>\r\n';
  const svgBlob = new Blob([preface, svgData], {type:"image/svg+xml;charset=utf-8"});
  const svgUrl = URL.createObjectURL(svgBlob);
  downloadFile(svgUrl, 'schema.svg');
}

function downloadPDF() {
  const svg = document.querySelector('#img-placeholder svg');
  // const svgData = svg.outerHTML.replace(/>[\n\r\s\t]+</g, '><');
  const svgData = encodeURIComponent(svg.outerHTML);
  Plotly.toImage(graphDiv, { format: 'png', width: 800, height: 600 }).then(function (dataUrl) {
    const inputs = Array.from(document.querySelectorAll('#sliders input[type="range"]'));
    let values = {};
    values['T_SWL'] = X_SWL.toFixed(2);
    values['X_SWL'] = Math.round(T_SWL / 5) * 5;
    values['MBL'] = Math.round((1.75 * T_SWL) / 5) * 5;
    inputs.forEach(elem => values[elem.id.replace(/\-/g, '_')] = elem.value);
    postData("/get-pdf", { ...values, svg: svgData, chart: dataUrl }).then(data => {
      downloadFile(data.url, data.name);
    });
  });
}

function downloadFile(url, name) {
  const link = document.createElement('a')
  document.body.appendChild(link)
  link.href = url;
  link.target = '_self';
  link.download = name;
  link.click();
  link.parentElement.removeChild(link);
}

function postData(url = "", data = {}) {
  return new Promise(resolve => {
    fetch(url, {
      method: "POST",
      mode: "cors",
      body: new URLSearchParams(data).toString(),
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
      }
    })
    .then(response => response.json())
    .then(json => resolve(json))
    .catch(err => console.error(err));
  });
}

// Initialization
window.addEventListener('DOMContentLoaded', function() {

  // download CSV routine
  const csvButton = document.querySelector('#download-csv');
  if (csvButton) {
    csvButton.addEventListener('click', event => {
      event.preventDefault();
      let [line_tension, LRD_extension, T_SWL, X_SWL, arm_length] = LRD_calc(
        Number(LRD_dia.value),
        Number(LRD_hei.value),
        Number(axes_horz_dist.value),
        Number(axes_vert_dist.value),
        Number(mooring_decl.value)
      );
      const dataLRD = LRD_extension
      const dataLineTension = line_tension;
      let rows = 'LRD Extension;Line Tension\n';
      for (let i = 0; i < dataLRD.length; i++) {
        if (dataLRD[i] && dataLineTension[i]) {
          rows += `${dataLRD[i].toString()};${dataLineTension[i].toString()}\n`;
        }
      }
      const blob = new Blob([rows], { type: 'text/csv' });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = 'stiffness_curve.csv';
      a.click();
    });
  }

  const pdfButton = document.querySelector('#download-pdf');
  if (pdfButton) {
    pdfButton.addEventListener('click', event => {
      event.preventDefault();
      downloadPDF();
      function enable(dis = false) {
        event.target.style.transition = 'opacity 200ms ease-in-out';
        event.target.style.pointerEvents = dis ? 'none' : 'all';
        event.target.style.opacity = dis ? '0.4' : '1';
      };
      enable(true);
      setTimeout(enable, 6000);
    });
  }

  const checkedEmail = window.sessionStorage.getItem('checked_email');
  if (checkedEmail) {
    unlockCalculator();
  }

  // workaround kirby form
  const form = document.querySelector('form#identify');
  const hiddenForm = document.querySelector('.kirby-form form');
  const iframe = document.querySelector('#hiddenIframe');
  if (form && hiddenForm && iframe) {
    form.addEventListener('submit', event => {
      event.preventDefault();
      const email = document.querySelector('input#email').value;
      if (email) {
        hiddenForm.target = 'hiddenIframe';
        hiddenForm.elements.email.value = email;
        window.sessionStorage.setItem('user_email', email);
        hiddenForm.submit();
      }
      document.body.classList.add('sending-email');
    });
    iframe.addEventListener('load', event => {
      const contents = iframe.contentWindow.document.body.innerHTML;
      const ok = contents.includes("Thank you for your submission!");
      if (ok) {
        unlockCalculator();
        const p = document.createElement('p');
        p.innerHTML = "<strong>Thank you for your submission!</strong>";
        form.replaceWith(p);
      } else {
        const msg = form.querySelector('.message');
        msg.innerHTML = "<p><strong>Please enter a valid email.</strong></p>";
        const field = form.querySelector('input#email');
        field.focus();
        field.select();
      }
      document.body.classList.remove('sending-email');
    });
  }
});