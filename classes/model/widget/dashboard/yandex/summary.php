<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @package		KodiCMS/Dashboard
 * @category	Widget
 * @author		butschster <butschster@gmail.com>
 * @link		http://kodicms.ru
 * @copyright  (c) 2012-2014 butschster
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt
 */
class Model_Widget_Dashboard_Yandex_Summary extends Model_Widget_Decorator_Dashboard {	
	
	/**
	 *
	 * @var boolean
	 */
	protected $_multiple = FALSE;	
	
	public $media_packages = array('chart');
	
	protected $_data = array();
	
	protected $_size = array(
		'x' => 4,
		'y' => 3,
		'max_size' => array(4, 3),
		'min_size' => array(4, 3)
	);
	
	public function fetch_data(){}
}