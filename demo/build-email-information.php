<?php

include '../vendor/autoload.php';

use Phant\EmailSender\Service\EmailBuilder;

$emailBuilder = new EmailBuilder();

$bodyHtml = nl2br(
    '<b>Lorem ipsum dolor sit amet</b>

Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
);

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
