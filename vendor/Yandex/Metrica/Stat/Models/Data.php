<?php

namespace Yandex\Metrica\Stat\Models;

use Yandex\Common\ObjectModel;

class Data extends ObjectModel {

	protected $collection = array(
	);
	protected $mappingClasses = array(
	);
	protected $propNameMap = array(
	);

	/**
	 * Add item
	 */
	public function add($items)
	{
		if (is_array($items))
		{
			$this->collection[] = new Summary\Items($items);
		}
		elseif (is_object($items) && $items instanceof Items)
		{
			$this->collection[] = $items;
		}

		return $this;
	}

	/**
	 * Get items
	 */
	public function getAll()
	{
		return $this->collection;
	}

}
