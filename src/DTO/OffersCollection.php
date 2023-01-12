<?php

namespace DTO;

use ArrayIterator;
use Iterator;

class OffersCollection implements OfferCollectionInterface {

	private ArrayIterator $iterator;

	public function __construct(array $items = []) {
		$this->iterator = new ArrayIterator($items);
	}

	public function get(int $index): OfferInterface {
		return $this->iterator->offsetGet($index);
	}

	public function getIterator(): Iterator {
		return $this->iterator;
	}

	public function count(): int {
		return $this->iterator->count();
	}
}
