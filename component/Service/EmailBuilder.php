<?php

declare(strict_types=1);

namespace Phant\EmailSender\Service;

use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;

class EmailBuilder
{
    public const TemplateEmail = 'layout.twig';
    public const TemplateComponentCta = 'component/cta.twig';
    public const TemplateComponentOtp = 'component/otp.twig';
    public const TemplateComponentMeta = 'component/meta.twig';
    public const TemplateComponentDivider = 'component/divider.twig';

    protected Twig $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Template/');

        $this->twig = new Twig($loader, [
            'debug' => true,
            'auto_reload' => true,
        ]);
    }

    public function build(
        string $bodyHtml,
        ?string $headerLogo,
        ?string $footerLogo,
        ?string $footerHtml
    ): string {
        return $this->twig->render(
            self::TemplateEmail,
            [
                'body_html' => $bodyHtml,
                'header_logo' => $headerLogo,
                'footer_logo' => $footerLogo,
                'footer_html' => $footerHtml,
            ]
        );
    }

    public function buildCta(
        string $url,
        string $label,
        ?string $backgroundColor = '#1E88E5',
        ?string $textColor = '#ffffff'
    ): string {
        return $this->twig->render(
            self::TemplateComponentCta,
            [
                'url' => $url,
                'label' => $label,
                'background_color' => $backgroundColor,
                'text_color' => $textColor,
            ]
        );
    }

    public function buildOtp(
        string $otp
    ): string {
        return $this->twig->render(
            self::TemplateComponentOtp,
            [
                'otp' => $otp,
            ]
        );
    }

    public function buildMeta(
        array $metas
    ): string {
        return $this->twig->render(
            self::TemplateComponentMeta,
            [
                'metas' => $metas,
            ]
        );
    }

    public function buildDivider(
    ): string {
        return $this->twig->render(
            self::TemplateComponentDivider
        );
    }
}
