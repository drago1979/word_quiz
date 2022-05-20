<?php


namespace App\Service;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class DictionaryService
{
	/**
	 * @const API_BASE_URL string
	 */
	const API_BASE_URL = 'https://api.dictionaryapi.dev/api/v2/entries/en/';

	/**
	 * @var $httpClient string
	 */
	protected $httpClient;

	/**
	 * DictionaryService constructor.
	 * @param HttpClientInterface $httpClient
	 */
	public function __construct(HttpClientInterface $httpClient)
	{
		$this->httpClient = $httpClient;
	}


	/**
	 * @param $word
	 * @return bool
	 * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
	 * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
	 * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
	 * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
	 */
	public function checkIfWordExists($word): bool
	{
		try {
			$response = $this->httpClient->request('GET', static::API_BASE_URL . $word);

			// Workaround for responses` lazy behaviour
			$data = $response->getContent();
		} catch (\Exception $e) {

			if ($e->getCode() == 404 && $e->getMessage() == 'No Definitions Found') {
				return false;
			}

			return ResponseService::response(false, $e->getMessage(), $e->getCode());
		}

		// For status codes not raising exceptions
		// (Might exclude redirection codes in the future).
		if ($response->getStatusCode() != 200) {
			return ResponseService::response(false, 'Attempt failed, try again.', 500);
		}

		return true;
	}
}