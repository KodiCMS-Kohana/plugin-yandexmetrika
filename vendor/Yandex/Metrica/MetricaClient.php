<?php

/**
 * Yandex PHP Library
 *
 * @copyright NIX Solutions Ltd.
 * @link https://github.com/nixsolutions/yandex-php-library
 */
/**
 * @namespace
 */

namespace Yandex\Metrica;

use Yandex\Common\AbstractServiceClient;
use Yandex\Common\Exception\ForbiddenException;
use Yandex\Common\Exception\UnauthorizedException;
use Yandex\Metrica\Exception\MetricaException;

/**
 * Class MetricaClient
 *
 * @category Yandex
 * @package Metrica
 *
 * @author   Alexander Khaylo <naxel@land.ru>
 * @created  12.02.14 15:46
 */
class MetricaClient extends AbstractServiceClient {

	/**
	 * API domain
	 *
	 * @var string
	 */
	protected $serviceDomain = 'api-metrika.yandex.ru/';

	/**
	 * @param string $token access token
	 */
	public function __construct($token = '')
	{
		$this->setAccessToken($token);
	}

	/**
	 * Get url to service resource with parameters
	 *
	 * @param string $resource
	 * @param array $params
	 * @see http://api.yandex.ru/metrika/doc/ref/concepts/method-call.xml
	 * @return string
	 */
	public function getServiceUrl($resource = '', $params = array())
	{
		$format = $resource === '' ? '' : '.json';
		$url = $this->serviceScheme . '://' . $this->serviceDomain . '/' . $resource . $format . '?oauth_token=' . $this->getAccessToken();

		if ($params)
		{
			$url .= '&' . http_build_query($params);
		}

		return $url;
	}

	/**
	 * Sends a request
	 *
	 * @param \Request $request
	 * @return Response
	 * @throws ForbiddenException
	 * @throws UnauthorizedException
	 * @throws MetricaException
	 */
	protected function sendRequest(\Request $request)
	{
		try
		{
			$request->headers('User-Agent', $this->getUserAgent());
			$response = $request->execute();
		} 
		catch (\Request_Exception $ex)
		{
			$code = $ex->getCode();
			$message = $ex->getMessage();

			if ($code === 403)
			{
				throw new ForbiddenException($message);
			}

			if ($code === 401)
			{
				throw new UnauthorizedException($message);
			}

			throw new MetricaException('Service responded with error code: "' . $code . '" and message: "' . $message . '"');
		}

		return $response;
	}

	/**
	 * Get OAuth data for header request
	 *
	 * @see http://api.yandex.ru/metrika/doc/ref/concepts/result-format.xml
	 *
	 * @return string
	 */
	protected function getOauthData()
	{
		return 'OAuth ' . $this->getAccessToken();
	}

	/**
	 * Send GET request to API resource
	 *
	 * @param string $resource
	 * @param array $params
	 * @return array
	 */
	protected function sendGetRequest($resource, $params = array())
	{
		$request = $this->_request($this->getServiceUrl($resource), $params);

		try
		{
			$response = $this->sendRequest($request);
			$data = json_decode($response->body(), true);

			if (isset($data['links']) && isset($data['links']['next']))
			{
				$url = $data['links']['next'];
				unset($data['rows']);
				unset($data['links']);
				$data = $this->getNextPartOfList($url, $data);
			}

			return $data;
		} 
		catch (Exception $ex)
		{
			
		}

		return array();
	}

	/**
	 * Send custom GET request to API resource
	 *
	 * @param string $url
	 * @param array $data
	 * @return array
	 */
	protected function getNextPartOfList($url, $data = array())
	{
		$request = $this->_request($url);
		$response = $this->sendRequest($request);
		$response_data = json_decode($response->body(), true);
		
		$response = array_merge_recursive($data, $response_data);
		if (isset($response['links']) && isset($response['links']['next']))
		{
			$url = $response['links'];
			unset($response['rows']);
			unset($response['links']);
			$response = $this->getNextPartOfList($url, $response);
		}

		return $response;
	}

	/**
	 * 
	 * @param string $url
	 * @return \Request
	 */
	protected function _request($url, array $params = array())
	{
		$request = \Request::factory($url, array(
			'header_callbacks' => array(
				'Content-Encoding' => function(\Request $request, \Response $response, \Request_Client $client) {
					// Uncompress the response
					$response->body(gzdecode($response->body()));
				}
			)
		))
			->query($params)
			->headers('Authorization', $this->getOauthData())
			->headers('Accept', 'application/x-yametrika+json')
			->headers('Content-type', 'application/x-yametrika+json');
			
		return $request;
	}
}
