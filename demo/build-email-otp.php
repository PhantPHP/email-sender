<?php

include '../vendor/autoload.php';

use Phant\EmailSender\Service\EmailBuilder;

$emailBuilder = new EmailBuilder();

$bodyHtml = nl2br(
    'Hello,

Here is the verification code you requested :'
);
$bodyHtml .= $emailBuilder->buildOtp('123456');
$bodyHtml .= nl2br(
    'This single-use code will expire in 15 minutes.

Thank you for your trust,
The Phant team'
);
$bodyHtml .= $emailBuilder->buildMeta([
    'IP address' => $_SERVER['REMOTE_ADDR'],
    'Browser' => $_SERVER['HTTP_USER_AGENT'],
    'Request date' => date('Y/m/d H:i:s'),
]);

$html = $emailBuilder->build(
    $bodyHtml,
    'image/logo.png',
    'image/logo.png',
    nl2br(
        'Made with passion, in France
		© Phant ' . date('Y')
    )
);

echo $html;
