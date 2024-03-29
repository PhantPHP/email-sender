# E-mail sender

## Requirments

PHP >= 8.1


## Install

`composer require phant/email-sender`

## Usages

### E-mail address validity checker

```php
use Phant\EmailSender\Service\EmailAddressValidator;

$emailAddressValidator = new EmailAddressValidator();

if (!$emailAddressValidator->checkTrashMailBoxService('john.doe@fake-box.com') {
	// E-mail address provided by a trash mail box service
}

if (!$emailAddressValidator->checkMxServer('john.doe@fake-box.com') {
	// E-mail address linked to a domain name without an e-mail server
}
```

### Html to text

Transform HTML 
```html
<section>
	<h1>Lorem ipsum dolor sit amet.</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	<ul>
		<li>Foo</li>
		<li>Bar</li>
	</ul>
	<p><a href="https://domain.ext/path">Action</a></p>
</section>
```

To TEXT 
```text
Lorem ipsum dolor sit amet.

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

- Foo
- Bar

Action : https://domain.ext/path
```


```php
use Phant\EmailSender\Service\HtmlToText;

$html = '';

$text = (new HtmlToText)(html);


```
