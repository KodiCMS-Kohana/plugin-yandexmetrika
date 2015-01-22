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

	public function get_summary()
	{
		$statClient = new \Yandex\Metrica\Stat\StatClient($this->access_token());

		$paramsModel = new \Yandex\Metrica\Stat\Models\Summary();
		$paramsModel
			->setId($this->plugin()->get('counter_id'));

		$data = $statClient->data()->summary($paramsModel);
		$this->response($data->toArray());
	}
}