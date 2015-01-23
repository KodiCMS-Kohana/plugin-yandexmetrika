<?php

namespace Yandex\Metrica\Stat\Models\Traffic;
use Yandex\Common\Model;

// https://tech.yandex.ru/metrika/doc/ref/stat/traffic-summary-docpage/

class SummaryParams extends Model {

	public $id = NULL;
	
	public $date1 = NULL;
	public $date2 = NULL;
	public $group = 'day';

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	public function setDate1($date)
	{
		$this->date1 = \Date::format($date, 'Ymd');
		return $this;
	}

	public function getDate1()
	{
		return $this->date1;
	}
	
	public function setDate2($date)
	{
		$this->date2 = \Date::format($date, 'Ymd');
		return $this;
	}

	public function getDate2()
	{
		return $this->date2;
	}
	
	public function setGroup($group)
	{
		if (in_array($group, array('day', 'month', 'week')))
		{
			$this->group = $group;
		}

		return $this;
	}
	
	public function getGroup()
	{
		return $this->group;
	}
}
