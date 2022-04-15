# E-mail sender

## Requirments

PHP >= 8.0


## Install

`composer require phant/email-sender`

## Usages

### E-mail address validity checker

```php
use Phant\EmailAddress\Service\EmailAddressValidator;

$emailAddressValidator = new EmailAddressValidator();

if (!$emailAddressValidator->checkTrashMailBoxService('john.doe@fake-box.com') {
	// E-mail address provided by a trash mail box service
}

if (!$emailAddressValidator->checkMxServer('john.doe@fake-box.com') {
	// E-mail address linked to a domain name without an e-mail server
}
```


### E-mail Sender via Sendinblue

```php
use Phant\Email\Service\SendinblueEmailSender;

// @todo : Create e-mail with [phant/data-structure](https://github.com/PhantPHP/data-structure)

apiKey = '*****.*****';

$sent = (new SendinblueEmailSender($apiKey))->send(email);
```
