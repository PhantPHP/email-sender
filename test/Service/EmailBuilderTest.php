<?php

declare(strict_types=1);

namespace Test\Service;

use Phant\EmailSender\Service\EmailBuilder;

final class EmailBuilderTest extends \PHPUnit\Framework\TestCase
{
    protected EmailBuilder $fixture;

    public function setUp(): void
    {
        $this->fixture = new EmailBuilder();
    }

    public function testBuild(): void
    {
        $html = $this->fixture->build(
            '<b>Lorem ipsum dolor sit amet</b>',
            'image/logo.png',
            'image/logo.png',
            '<b>Lorem ipsum dolor sit amet</b>'
        );

        $this->assertIsString($html);
    }

    public function testBuildCta(): void
    {
        $html = $this->fixture->buildCta(
            'https://github.com/PhantPHP',
            'Github',
            '#000000',
            '#FFFFFF'
        );

        $this->assertIsString($html);
    }

    public function testBuildOtp(): void
    {
        $html = $this->fixture->buildOtp('123456');

        $this->assertIsString($html);
    }

    public function testBuildMeta(): void
    {
        $html = $this->fixture->buildMeta([
            'key' => 'value',
        ]);

        $this->assertIsString($html);
    }
}
