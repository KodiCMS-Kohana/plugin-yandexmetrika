<?php

namespace Yandex\Metrica\Stat;

use Yandex\Metrica\Stat\StatClient;

/**
 * Class DataClient
 *
 * @category Yandex
 * @package Metrica
 *
 * @author   Tanya Kalashnik
 * @created  18.07.14 15:37
 */
class DataClient extends StatClient {

	/**
	 * Get data by time
	 *
	 * @see http://api.yandex.ru/metrika/doc/beta/api_v1/bytime.xml
	 *
	 * @param Models\ByTimeParams $params
	 * @return Models\ByTimeData
	 */
	public function summary(Models\Summary $params)
	{
		$resource = 'stat/traffic/summary';
		$response = $this->sendGetRequest($resource, $params->toArray());
		$dataResponse = new Models\Summary($response);
		return $dataResponse;
	}

}
