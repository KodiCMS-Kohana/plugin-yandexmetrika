<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @package		KodiCMS/Dashboard
 * @category	Widget
 * @author		butschster <butschster@gmail.com>
 * @link		http://kodicms.ru
 * @copyright  (c) 2012-2014 butschster
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt
 */
class Model_Widget_Dashboard_Yandex_Sources_Summary extends Model_Widget_Decorator_Dashboard {	
	
	/**
	 *
	 * @var boolean
	 */
	protected $_multiple = FALSE;	
	
	public $media_packages = array('chart');
	
	protected $_data = array(
		'chart_type' => 'pie'
	);
	
	public $header = 'Sources Summary';

	protected $_size = array(
		'x' => 2,
		'y' => 3,
		'max_size' => array(5, 5),
		'min_size' => array(2, 2)
	);
	
	public function fetch_data(){}
}