<?php

include '../vendor/autoload.php';

use Phant\EmailSender\Service\EmailBuilder;

$emailBuilder = new EmailBuilder();

$bodyHtml = nl2br(
    'Hello,

Would you like to find out more about our work?

Visit our Github page:'
);
$bodyHtml .= $emailBuilder->buildCta(
    'https://github.com/PhantPHP',
    'Github'
);
$bodyHtml .= nl2br(
    'Thank you for your trust,
The Phant team'
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
