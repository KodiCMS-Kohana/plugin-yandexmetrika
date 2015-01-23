<?php defined( 'SYSPATH' ) or die( 'No direct access allowed.' );

class Controller_Api_Plugin_Yandex extends Controller_System_API
{
	/**
	 *
	 * @var Plugin
	 */
	protected $_plugin = NULL;
	
	public function plugin()
	{
		if($this->_plugin === NULL)
		{
			$this->_plugin = Plugins::get_registered('yandexmetrika');
		}
		
		if (!($this->_plugin instanceof Plugin_Decorator))
		{
			throw HTTP_API_Exception::factory(API::ERROR_UNKNOWN, 'Plugin not loaded');
		}
		
		return $this->_plugin;
	}
	
	public function access_token()
	{
		$token = $this->plugin()->get('access_token');
		
		if($token === NULL)
		{
			throw HTTP_API_Exception::factory(API::ERROR_TOKEN, 'Access tonek not requested');
		}
		
		return $token;
	}

	public function get_traffic_summary()
	{
		$date_start = $this->param('date_start', date('Y-m-d', strtotime('-1 week')));
		$date_end = $this->param('date_end', date('Y-m-d'));
		
		$statClient = new \Yandex\Metrica\Stat\StatClient($this->access_token());

		$paramsModel = new \Yandex\Metrica\Stat\Models\Traffic\SummaryParams();
		$paramsModel
			->setId($this->plugin()->get('counter_id'));
		
		if (Valid::date($date_start))
		{
			$paramsModel->setDate1($date_start);
		}

		if (Valid::date($date_end))
		{
			$paramsModel->setDate2($date_end);
		}

		$data = $statClient->data()->traffic_summary($paramsModel);
		$this->response($data->toArray());
	}
	
	public function get_sources_summary()
	{
		$date_start = $this->param('date_start', date('Y-m-d', strtotime('-1 week')));
		$date_end = $this->param('date_end', date('Y-m-d'));
		
		$statClient = new \Yandex\Metrica\Stat\StatClient($this->access_token());

		$paramsModel = new \Yandex\Metrica\Stat\Models\Sources\SummaryParams();
		$paramsModel
			->setId($this->plugin()->get('counter_id'));
		
		if (Valid::date($date_start))
		{
			$paramsModel->setDate1($date_start);
		}

		if (Valid::date($date_end))
		{
			$paramsModel->setDate2($date_end);
		}

		$data = $statClient->data()->sources_summary($paramsModel);
		$this->response($data->toArray());
	}
}