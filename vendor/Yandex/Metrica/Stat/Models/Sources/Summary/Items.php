<?php

namespace Yandex\Metrica\Stat\Models\Sources\Summary;

use Yandex\Common\Model;

class Items extends Model {

	public $depth = 0;
	public $name;
	public $denial = 0;
	public $visits = 0;
	public $page_views = 0;

	protected $propNameMap = array(
		'depth' => 'depth',
		'denial' => 'denial',
		'visits' => 'visits',
		'page_views' => 'page_views',
		'name' => 'name'
	);
}