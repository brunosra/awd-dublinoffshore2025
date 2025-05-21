<?php
return function($kirby, $pages, $page) {

    $alert = null;

    if($kirby->request()->is('POST') && get('submit')) {

        // check the honeypot
        if(empty(get('website')) === false) {
            go($page->url());
            exit;
        }

        $data = [
            'name'  => get('name'),
            'company' => get('company'),
            'email' => get('email'),
            'tel' => get('tel'),
            'text'  => get('text'),
        ];

        $rules = [
            'name'  => ['required', 'minLength' => 3],
            'company' => ['required', 'minLength' => 3],
            'email' => ['required', 'email'],
            'tel' => ['required', 'minLength' => 3],
            'text'  => ['required', 'minLength' => 3, 'maxLength' => 3000],
        ];

        $messages = [
            'name'  => 'Please enter a valid name',
            'company' => 'Please enter a valid company name',
            'email' => 'Please enter a valid email address',
            'tel' => 'Please enter a valid phone number',
            'text'  => 'Please enter a text between 3 and 3000 characters',
        ];

        // some of the data is invalid
        if($invalid = invalid($data, $rules, $messages)) {
            $alert = $invalid;

            // the data is fine, let's send the email
        } else {
            try {
                $kirby->email([
                    'template' => 'email',
                    'from'     => 'sayhello@dublinoffshore.ie',
                    'replyTo'  => ($data['email']),
                    'to'       => 'sayhello@dublinoffshore.ie',
                    'subject'  => esc($data['name']) . ' sent you a message from your contact form',
                    'data'     => [
                        'name'  => esc($data['name']),
                        'company' => esc($data['company']),
                        'email' => esc($data['email']),
                        'tel' => esc($data['tel']),
                        'text'   => esc($data['text'])
                    ]
                ]);

            } catch (Exception $error) {
                if(option('debug')):
                    $alert['error'] = 'The form could not be sent: <strong>' . $error->getMessage() . '</strong>';
                else:
                    $alert['error'] = 'The form could not be sent: <strong>' . $error->getMessage() . '</strong>';
                    // $alert['error'] = 'The form could not be sent!';
                endif;
            }

            // no exception occurred, let's send a success message
            if (empty($alert) === true) {
                $success = 'Your message has been sent, thank you. We will get back to you soon!';
                $data = [];
            }
        }
    }

    return [
        'alert'   => $alert,
        'data'    => $data ?? false,
        'success' => $success ?? false
    ];
};
