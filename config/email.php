<?php

/*
PHPMailer Configuration
[
    "transport" => "PHPMailer",
    "config" => [
        "smtp" => true,
        "user" => "39c14f16992e68",
        "pass" => '05a410b79eccdd',
        "host" => "smtp.mailtrap.io",
        "port" => "465",
        "secure" => "tls",
        "auth" => true,
        "debug" => true,
    ]
];
*/
/*
    Mailgun Configuration
[
    "transport" => "Mailgun",
    "config" => [
        "smtp" => true, // if TRUE it will use PHPMailer as SMTP, if not it will use the API
        "apikey" => "key-ff09eed4ec3c2d0bdab7e6bd3e4a80d4",
        "user" => "postmaster@sandbox41886a22d5bf4b2fa3439ca0f98a4dfe.mailgun.org",
        "pass" => 'qwe123qwe',
        "host" => "smtp.mailgun.org",
        "domain" => "sandbox41886a22d5bf4b2fa3439ca0f98a4dfe.mailgun.org",
        "port" => "587",
        "secure" => "tls",
        "auth" => true,
        "debug" => true,
    ]
];
*/

return [
    "transport" => "PHPMailer",
    "config" => [
        "smtp" => true,
        "user" => "39c14f16992e68",
        "pass" => '05a410b79eccdd',
        "host" => "smtp.mailtrap.io",
        "port" => "465",
        "secure" => "tls",
        "auth" => true,
        "debug" => true,
    ]
];
