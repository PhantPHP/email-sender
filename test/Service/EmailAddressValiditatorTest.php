<?php
declare(strict_types=1);

namespace Test\Service;
use PHPUnit\Framework\TestCase;

use Phant\DataStructure\Web\EmailAddress;
use Phant\EmailSender\Service\EmailAddressValiditator;

final class EmailAddressValiditatorTest extends TestCase
{
	public function testCheckTrashMailBoxService(): void
	{
		$this->assertIsBool(
			(new EmailAddressValiditator())
				->checkTrashMailBoxService(
					'username@domain.ext'
				)
		);
		
		$this->assertIsBool(
			(new EmailAddressValiditator())
				->checkTrashMailBoxService(
					new EmailAddress('username@domain.ext')
				)
		);
	}
	
	public function testCheckMxServer(): void
	{
		$this->assertIsBool(
			(new EmailAddressValiditator())
				->checkMxServer(
					'username@domain.ext'
				)
		);
		
		$this->assertIsBool(
			(new EmailAddressValiditator())
				->checkMxServer(
					new EmailAddress('username@domain.ext')
				)
		);
	}
}
