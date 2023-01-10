<?php

declare(strict_types=1);

namespace Phant\EmailSender\Service;

final class HtmlToText
{
    public function __invoke(
        string $html
    ): string {
        $html = self::removeCodeIndent($html);
        $html = self::removeCodeFormating($html);

        $html = self::transformTagA($html);
        $html = self::transformTagBr($html);
        $html = self::transformTagLi($html);

        $html = self::removeNonTextStructuringTags($html);
        $html = self::removeTextStructuringTags($html);

        $html = self::cleanText($html);

        return $html;
    }

    public static function removeCodeIndent(
        string $html
    ): string {
        $lines = explode("\n", $html);
        foreach ($lines as $k => $line) {
            $lines[$k] = trim($line);
        }
        $html = implode("\n", $lines);

        return $html;
    }

    public static function removeCodeFormating(
        string $html
    ): string {
        $html = trim($html);
        $html = str_replace(["\r", "\n"], '', $html);
        $html = preg_replace('/\t+/', ' ', $html);
        $html = preg_replace('/ +/', ' ', $html);

        return $html;
    }

    public static function transformTagA(
        string $html
    ): string {
        return preg_replace("/<a .*? ?href=[\"']([^\"']*)[\"'].*?>\n*(.*?)\n*<\/a>/i", "$2 : $1", $html);
    }

    public static function transformTagBr(
        string $html
    ): string {
        return preg_replace('/(<\/?br>)/is', "\n", $html);
    }

    public static function transformTagLi(
        string $html
    ): string {
        return preg_replace('/(<li ?.*?>)/is', "$1- ", $html);
    }

    public static function removeNonTextStructuringTags(
        string $html
    ): string {
        $html = self::removeCodeIndent($html);
        $html = preg_replace('/(<\/(address|article|aside|blockquote|div|fieldset|footer|form|header|main|nav|pre|section)>)/is', "$1\n", $html);
        $html = strip_tags($html, ['<h1>','<h2>','<h3>','<h4>','<h5>','<h6>','<p>','<ol>','<ul>', '<li>']);
        $html = preg_replace("/\n{2,}/", "\n", $html);
        $html = trim($html);

        return $html;
    }

    public static function removeTextStructuringTags(
        string $html
    ): string {
        $html = self::removeCodeIndent($html);
        $html = preg_replace('/(<\/(dd|dl|dt|li|ol|ul)>)/is', "$1\n", $html);
        $html = preg_replace('/(<(h([1-6]))(.*?)>)/is', "\n\n$1", $html);
        $html = preg_replace('/(<\/(h([1-6]))(.*?)>)/is', "$1\n\n", $html);
        $html = preg_replace('/(<\/p(.*?)>)/is', "$1\n\n", $html);
        $html = strip_tags($html);
        $html = preg_replace("/\n{3,}/", "\n\n\n", $html);
        $html = trim($html);

        return $html;
    }

    public static function cleanText(
        string $text
    ): string {
        $lines = explode("\n", $text);
        foreach ($lines as $k => $line) {
            $lines[$k] = trim($line);
        }
        $text = implode("\n", $lines);

        $text = preg_replace('/ +/', ' ', $text);
        $text = trim($text);

        return $text;
    }
}
