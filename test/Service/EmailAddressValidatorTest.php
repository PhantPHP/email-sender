<?php

declare(strict_types=1);

namespace Test\Service;

use Phant\DataStructure\Web\EmailAddress;
use Phant\EmailSender\Service\EmailAddressValidator;

final class EmailAddressValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testCheckTrashMailBoxService(): void
    {
        $this->assertIsBool(
            (new EmailAddressValidator())
                ->checkTrashMailBoxService(
                    'username@domain.ext'
                )
        );

        $this->assertIsBool(
            (new EmailAddressValidator())
                ->checkTrashMailBoxService(
                    new EmailAddress('username@domain.ext')
                )
        );
    }

    public function testCheckMxServer(): void
    {
        $this->assertIsBool(
            (new EmailAddressValidator())
                ->checkMxServer(
                    'username@domain.ext'
                )
        );

        $this->assertIsBool(
            (new EmailAddressValidator())
                ->checkMxServer(
                    new EmailAddress('username@domain.ext')
                )
        );
    }
}
