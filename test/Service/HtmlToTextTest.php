<?php

declare(strict_types=1);

namespace Test\Service;

use Phant\EmailSender\Service\HtmlToText;

final class HtmlToTextTest extends \PHPUnit\Framework\TestCase
{
    protected string $fixture;

    public function setUp(): void
    {
        $this->fixture = '
        <header>
            <nav><p>The nav</p></nav>
        </header>
        <main>
            <section>
                <article>
                    <address>
                        <p>The address</p>
                    </address>
                    <blockquote><p>The blockquote</p></blockquote>
                    <fieldset><p>The fieldset</p></fieldset>
                    <form><p>The form</p></form>
                    <pre><p>The pre</p></pre>
                    <h1>The h1</h1>
                    <h2>The h2</h2>
                    <h3>The h3</h3>
                    <h4>The h4</h4>
                    <h5>The h5</h5>
                    <h6>The h6</h6>
                    <p>Lorem ipsum dolor sit amet... <a class="foo" href="https://domain/ext/path" id="bar">FOO BAR</a></p>
                    <ul>
                        <li>The li</li>
                        <li>The li</li>
                    </ul>
                    <ol>
                        <li>The li</li>
                        <li>The li</li>
                    </ol>
                </article>
            </section>
        </main>
        <aside>
            <p>The aside</p>
        </aside>
        <footer>
            <p>The footer</p>
        </footer>
        ';
    }

    public function testInvoke(): void
    {
        $this->assertEquals(
            'The nav' . "\n"
            . "\n"
            . "\n"
            . 'The address' . "\n"
            . "\n"
            . "\n"
            . 'The blockquote' . "\n"
            . "\n"
            . "\n"
            . 'The fieldset' . "\n"
            . "\n"
            . "\n"
            . 'The form' . "\n"
            . "\n"
            . "\n"
            . 'The pre' . "\n"
            . "\n"
            . "\n"
            . 'The h1' . "\n"
            . "\n"
            . "\n"
            . 'The h2' . "\n"
            . "\n"
            . "\n"
            . 'The h3' . "\n"
            . "\n"
            . "\n"
            . 'The h4' . "\n"
            . "\n"
            . "\n"
            . 'The h5' . "\n"
            . "\n"
            . "\n"
            . 'The h6' . "\n"
            . "\n"
            . 'Lorem ipsum dolor sit amet... FOO BAR : https://domain/ext/path' . "\n"
            . "\n"
            . '- The li' . "\n"
            . '- The li' . "\n"
            . "\n"
            . '- The li' . "\n"
            . '- The li' . "\n"
            . "\n"
            . "\n"
            . 'The aside' . "\n"
            . "\n"
            . "\n"
            . 'The footer',
            (new HtmlToText)($this->fixture)
        );
    }

    public function testRemoveCodeFormating(): void
    {
        $this->assertEquals(
            "<p>FOO BAR</p> <p>FOO BAR</p>",
            HtmlToText::removeCodeFormating('
            
            <p>FOO BAR</p>
            <p>FOO 
            BAR</p>
            
            ')
        );
    }

    public function testTransformTagA(): void
    {
        $this->assertEquals(
            '<p>Lorem ipsum dolor sit amet... FOO BAR : https://domain/ext/path</p>',
            HtmlToText::transformTagA(
                '<p>Lorem ipsum dolor sit amet... <a class="foo" href="https://domain/ext/path" id="bar">FOO BAR</a></p>'
            )
        );
    }

    public function testTransformTagBr(): void
    {
        $this->assertEquals(
            "<p>Foo\nBar</p>",
            HtmlToText::transformTagBr(
                '<p>Foo<br>Bar</p>'
            )
        );
    }

    public function testTransformTagLi(): void
    {
        $this->assertEquals(
            '<ul><li>- Foo</li><li>- Bar</li></ul>',
            HtmlToText::transformTagLi(
                '<ul><li>Foo</li><li>Bar</li></ul>'
            )
        );
    }

    public function testRemoveNonTextStructuringTags(): void
    {
        $this->assertEquals(
            '<p>The nav</p>' . "\n"
            . '<p>The address</p>' . "\n"
            . '<p>The blockquote</p>' . "\n"
            . '<p>The fieldset</p>' . "\n"
            . '<p>The form</p>' . "\n"
            . '<p>The pre</p>' . "\n"
            . '<h1>The h1</h1>' . "\n"
            . '<h2>The h2</h2>' . "\n"
            . '<h3>The h3</h3>' . "\n"
            . '<h4>The h4</h4>' . "\n"
            . '<h5>The h5</h5>' . "\n"
            . '<h6>The h6</h6>' . "\n"
            . '<p>Lorem ipsum dolor sit amet... FOO BAR</p>' . "\n"
            . '<ul>' . "\n"
            . '<li>The li</li>' . "\n"
            . '<li>The li</li>' . "\n"
            . '</ul>' . "\n"
            . '<ol>' . "\n"
            . '<li>The li</li>' . "\n"
            . '<li>The li</li>' . "\n"
            . '</ol>' . "\n"
            . '<p>The aside</p>' . "\n"
            . '<p>The footer</p>',
            HtmlToText::removeNonTextStructuringTags($this->fixture)
        );
    }

    public function testRemoveTextStructuringTags(): void
    {
        $this->assertEquals(
            'The nav' . "\n"
            . "\n"
            . "\n"
            . 'The address' . "\n"
            . "\n"
            . "\n"
            . 'The blockquote' . "\n"
            . "\n"
            . "\n"
            . 'The fieldset' . "\n"
            . "\n"
            . "\n"
            . 'The form' . "\n"
            . "\n"
            . "\n"
            . 'The pre' . "\n"
            . "\n"
            . "\n"
            . 'The h1' . "\n"
            . "\n"
            . "\n"
            . 'The h2' . "\n"
            . "\n"
            . "\n"
            . 'The h3' . "\n"
            . "\n"
            . "\n"
            . 'The h4' . "\n"
            . "\n"
            . "\n"
            . 'The h5' . "\n"
            . "\n"
            . "\n"
            . 'The h6' . "\n"
            . "\n"
            . "\n"
            . 'Lorem ipsum dolor sit amet... FOO BAR' . "\n"
            . "\n"
            . "\n"
            . 'The li' . "\n"
            . "\n"
            . 'The li' . "\n"
            . "\n"
            . "\n"
            . 'The li' . "\n"
            . "\n"
            . 'The li' . "\n"
            . "\n"
            . "\n"
            . 'The aside' . "\n"
            . "\n"
            . "\n"
            . 'The footer',
            HtmlToText::removeTextStructuringTags($this->fixture)
        );
    }
}
