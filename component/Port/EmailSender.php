<?php
declare(strict_types=1);

namespace Phant\EmailSender\Port;
use Phant\DataStructure\Web\Email;

interface EmailSender
{
	public function send(Email $email): bool;
}
