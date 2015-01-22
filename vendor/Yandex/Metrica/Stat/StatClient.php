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

namespace Yandex\Metrica\Stat;

use Yandex\Metrica\MetricaClient;

class StatClient extends MetricaClient {

	/**
	 * API domain
	 *
	 * @var string
	 */
	protected $serviceDomain = 'api-metrika.yandex.ru';

	/**
	 * @return DataClient
	 */
	public function data()
	{
		return new DataClient($this->getAccessToken());
	}

}
