<?php
declare(strict_types=1);

namespace Amocrmapi\V2;

use Amocrmapi\Dependencies\EntityApiInterface;
use Amocrmapi\Dependencies\EntityInterface;
use Amocrmapi\Exceptions\AuthException;
use Amocrmapi\V2\Helpers\Client;

/**
 * Main api class
 */
class API
{
	/**
	 * Amocrm subdomain - https://{$subdomain}.amocrm.ru
	 *
	 * @var string
	 */
	private $subdomain;

	/**
	 * Amocrm login - email address
	 *
	 * @var string
	 */
	private $login;

	/**
	 * Amocrm secret hash - AmoCRM -> settings -> API -> Your api key
	 *
	 * @var string
	 */
	private $hash;

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
	 * @param $subdomain string
	 * @param $login string
	 * @param $hash string
	 */
	public function __construct(string $subdomain, string $login, string $hash)
	{
		$this->subdomain = $subdomain;
		$this->login = $login;
		$this->hash = $hash;
	}

    /**
     * Try connect to amocrm
     *
     * @throws AuthException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return API
     */
	public function connect()
	{
		$this->client = new Client;
		$data = [
            'USER_LOGIN' =>  $this->login,
            'USER_HASH' => $this->hash
        ];
    	$data = $this->request("/private/api/auth.php?type=json", $data);

    	if (!$data["response"]["auth"])
    		throw new AuthException(
    			$data["response"]["error"],
    			(int) $data["response"]["error_code"]
    		);

    	return $this;
	}

    /**
     * Send request to amocrm
     *
     * @param string $uri
     * @param array|string $params
     * @param string $method
     * @param bool $hash - add hash to link
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array
     */
	public function request(
		string $uri,
		$params,
		string $method = "POST",
		bool $hash = false
	) : array
	{
		$uri = "https://{$this->subdomain}.amocrm.ru{$uri}";

		if ($hash) $uri .= "?login={$this->login}&api_key={$this->hash}";

		return $this->client->request($uri, $params, $method);
	}

	/**
	 * Entity fabric method
	 * 
	 * @param string $entity
	 * 
	 * @return \Amocrmapi\Dependencies\EntityInterface
	 */
	public function create(string $entity) : EntityInterface
	{
		$entity = "\Amocrmapi\Entity\\" . ucfirst(strtolower($entity));

		return new $entity;
	}

	/**
	 * Get instance of api by type
	 * 
	 * @param string $type
	 * 
	 * @return \Amocrmapi\Dependencies\DefaultEntityApiInterface
	 */
	public function get(string $type) : EntityApiInterface
	{
		$apiType = "\Amocrmapi\V2\Api\\" . ucfirst(
			str_replace(
				"api",
				"Api",
				strtolower($type)
			)
		);

		return $apiType::getInstance()->init($this);
	}
}