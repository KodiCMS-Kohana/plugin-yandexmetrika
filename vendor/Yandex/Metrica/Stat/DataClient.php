<?php

namespace Yandex\Metrica\Stat;

use Yandex\Metrica\Stat\StatClient;

class DataClient extends StatClient {

	public function traffic_summary(Models\Traffic\SummaryParams $params)
	{
		$response = $this->sendGetRequest('stat/traffic/summary', $params->toArray());
		$dataResponse = new Models\Traffic\Summary($response);
		return $dataResponse;
	}
	
	public function sources_summary(Models\Sources\SummaryParams $params)
	{
		$response = $this->sendGetRequest('stat/sources/summary', $params->toArray());
		$dataResponse = new Models\Sources\Summary($response);
		return $dataResponse;
	}

}
