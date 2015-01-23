<?php

namespace Yandex\Metrica\Stat\Models\Sources;
use Yandex\Common\Model;

// https://tech.yandex.ru/metrika/doc/ref/stat/sources-summary-docpage/

class SummaryParams extends Model {

	public $id = NULL;
	
	public $date1 = NULL;
	public $date2 = NULL;
	public $sort = 'visits';
	public $reverse = 1;

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
	
	public function setSort($sort)
	{
		if (in_array($sort, array('visits')))
		{
			$this->sort = $sort;
		}

		return $this;
	}
	
	public function getSort()
	{
		return $this->sort;
	}
	
	public function setReverse($reverse)
	{
		$this->reverse = (int) $reverse > 0 ? 1 : 0;

		return $this;
	}
	
	public function getReverse()
	{
		return $this->reverse;
	}
}
