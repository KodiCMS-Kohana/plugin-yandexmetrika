<?php defined('SYSPATH') or die('No direct access allowed.');

use Yandex\OAuth\OAuthClient;
use Yandex\OAuth\Exception\AuthRequestException;
		
/**
 * @package		KodiCMS/Yandex
 * @category	Controller
 * @author		butschster <butschster@gmail.com>
 * @link		http://kodicms.ru
 * @copyright	(c) 2012-2014 butschster
 * @license		http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt
 */
class Controller_Yandex extends Controller_System_Backend
{
	public function action_request_token() 
	{
		$this->auto_render = FALSE;
		
		$plugin = \Plugins::get_registered('yandexmetrika');
		
		$client = new OAuthClient($plugin->get('client_id'));
		$client->authRedirect(true, OAuthClient::CODE_AUTH_TYPE, Text::random());
	}

	public function action_access_token() 
	{
		$this->auto_render = FALSE;

		$code = Request::current()->query('code');

		if ($code === NULL)
		{
			throw new AuthRequestException('Code not found');
		}

		$plugin = \Plugins::get_registered('yandexmetrika');
		
		$client = new OAuthClient($plugin->get('client_id'), $plugin->get('client_secret'));
		try
		{
			// осуществляем обмен
			$client->requestAccessToken($code);
			$token = $client->getAccessToken();

			$plugin
				->set('access_token', $token)
				->save_settings();
	
		} 
		catch (AuthRequestException $ex)
		{
			echo $ex->getMessage();
		}
		
		$this->go(Route::get('plugins')->uri(array(
			'controller' => 'plugins',
			'action' => 'settings',
			'id' => $plugin->id()
		)));
	}
}