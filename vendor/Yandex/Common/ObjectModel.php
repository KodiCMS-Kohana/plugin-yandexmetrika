<?php

/**
 * Yandex PHP Library
 *
 * @copyright NIX Solutions Ltd.
 * @link https://github.com/nixsolutions/yandex-php-library
 */
/**
 * @namespace
 */

namespace Yandex\Common;

class ObjectModel extends Model implements \Iterator {

	protected $collection = array();
	protected $innerCounter = -1;

	public function current()
	{
		if (is_array(current($this->collection)))
		{
			return new ObjectModel(current($this->collection));
		}

		return current($this->collection);
	}

	public function next()
	{
		$this->innerCounter++;
		return next($this->collection);
	}

	public function key()
	{
		return key($this->collection);
	}

	public function valid()
	{
		return $this->innerCounter < count($this->collection);
	}

	public function rewind()
	{
		$this->innerCounter = 0;
		return;
	}

}
