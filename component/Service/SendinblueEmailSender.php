<?php
declare(strict_types=1);

namespace Phant\EmailSender\Service;

use Phant\DataStructure\Web\Email;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;

/*
 * Documentation : https://developers.sendinblue.com/docs
 */

final class SendinblueEmailSender implements \Phant\EmailSender\Port\EmailSender
{
	protected string $apiKey;
	
	public function __construct(string $apiKey)
	{
		$this->apiKey = $apiKey;
	}
	
	public function send(Email $email): bool
	{
		$headers = [
			'api-key' => $this->apiKey,
			'Accept' => 'application/json',
			'Content-Type' => 'application/json',
		];
		
		$body = [
			'sender' => [
				'email' => (string)$email->from->getEmailAddress(),
				'name' => $email->from->getName(),
			],
			'to' => [
				[
					'email' => (string)$email->to->getEmailAddress(),
					'name' => $email->to->getName(),
				],
			],
			'subject' => $email->subject,
		];
		
		if ($email->messageTxt) {
			$body['textContent'] = $email->messageTxt;
		}
		
		if ($email->messageHtml) {
			$body['htmlContent'] = $email->messageHtml;
		}
		
		$response = (new HttpClient([
			'base_uri' => 'https://api.sendinblue.com'
		]))->request(
			'POST',
			'/v3/smtp/email',
			[
				'headers' => $headers,
				'json' => $body,
				'http_errors' => false,
			]
		);
		
		if ($response->getStatusCode() != 201) {
			return false;
		}
		
		return true;
	}
}
