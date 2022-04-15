<?php
declare(strict_types=1);

namespace Phant\EmailSender\Service;

use Phant\DataStructure\Web\EmailAddress;
use Phant\DomainName\Service\{
	DnsRecord,
	ServiceProvided,
};
use Phant\EmailAddress\Error\EmailAddress\{
	IsTrashMailBoxService,
	EmailServerNotFound,
};

class EmailAddressValidator
{
	public function __construct()
	{
	}
	
	public function checkTrashMailBoxService(string|EmailAddress $emailAddress): bool
	{
		if (is_string($emailAddress)) $emailAddress = new EmailAddress($emailAddress);
		
		return (new ServiceProvided())->isTrashMailBoxService(
			$emailAddress->getDomainName()
		);
	}
	
	public function checkMxServer(string|EmailAddress $emailAddress): bool
	{
		if (is_string($emailAddress)) $emailAddress = new EmailAddress($emailAddress);
		
		return (new DnsRecord())->exist(
			$emailAddress->getDomainName(),
			DnsRecord::MX
		);
	}
}
