<?php

namespace Yandex\Metrica\Stat\Models\Sources;

use Yandex\Common\Model;

// https://tech.yandex.ru/metrika/doc/ref/stat/sources-summary-docpage/

class Summary extends Model {

	public $date_start;
	public $date_end;
	public $data = array();
	public $totals = 0;
	protected $mappingClasses = array(
		'data' => 'Yandex\Metrica\Stat\Models\Sources\Summary\Data'
	);
	protected $propNameMap = array(
		'date1' => 'date_start',
		'date2' => 'date_end',
		'data' => 'data',
		'totals' => 'totals'
	);

	/**
	 * Retrieve the id property
	 *
	 * @return int|null
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the id property
	 *
	 * @param int $id
	 * @return $this
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

}
