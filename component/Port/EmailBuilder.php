<?php

declare(strict_types=1);

namespace Phant\EmailSender\Port;

interface EmailBuilder
{
    public function getText(mixed $datas): string;
    
    public function getHtml(mixed $datas): string;
}
