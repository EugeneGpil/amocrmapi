<?php
declare(strict_types=1);

namespace Amocrmapi\V2\Helpers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Cookie\CookieJar;
use Amocrmapi\Exceptions\EmptyResponseException;

/**
 * Helper for work with Guzzle
 */
class Client
{

	/**
	 * Http guzzle client
	 *
	 * @var GuzzleClient
	 */
	private $client;

	/**
	 * AmoCrm cookies
	 *
	 * @var CookieJar
	 */
	private $cookies;

	/**
     * HTTPClient constructor.
     */
	public function __construct()
	{
		$this->cookies = new CookieJar;
		$this->client = new GuzzleClient(["cookies" => $this->cookies]);
	}

    /**
     * Send request
     *
     * @param string $uri
     * @param array|string $params
     * @param string $method
     *
     * @throws EmptyResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array
     */
	public function request(string $uri, $params, string $method) : array
	{
		$body = [
			"headers" => [
				"User-Agent" => "Freshcube-Client/1.0",
				"Accept"     => "application/json",
			],
			"verify" => false,
			"cookies" => $this->cookies,
		];
		$method === "GET" ? $uri .= $params : $body["form_params"] = $params;

		try {
			$result = $this->client->request($method, $uri, $body);
			$result = json_decode($result->getBody()->getContents(), true);
		} catch (\GuzzleHttp\Exception\ClientException $exception) {
        	$result = json_decode($exception->getResponse()->getBody()->getContents(), true);
        }

        if (is_null($result)) throw new EmptyResponseException;

		return $result;
	}
}
