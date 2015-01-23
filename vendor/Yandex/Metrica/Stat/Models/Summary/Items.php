<?php

namespace Yandex\Metrica\Stat\Models\Summary;

use Yandex\Common\Model;

class Items extends Model {

	public $depth = 0;
	public $date;
	public $denial = 0;
	public $visits = 0;
	public $visitors = 0;
	public $page_views = 0;
	protected $propNameMap = array(
		'depth' => 'depth',
		'date' => 'date',
		'denial' => 'denial',
		'visits' => 'visits',
		'visitors' => 'visitors',
		'page_views' => 'page_views'
	);

	public function setDate($date)
	{
		$date = date_parse_from_format('Ymd', $date);
		$this->date = \Date::format($date, 'd.m');
		return $this;
	}
}
