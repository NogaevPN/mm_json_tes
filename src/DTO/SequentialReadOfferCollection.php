<?php

namespace DTO;

use Iterator;
use JsonMachine\Items;

class SequentialReadOfferCollection implements OfferCollectionInterface {

	private Items $streamItems;

	public function __construct(Items $items) {
		$this->streamItems = $items;
	}

	public function get(int $index): OfferInterface {
		foreach ($this->streamItems as $key => $item) {
			if ((int)$key === $index) {
				return new Offer($item);
			}
		}
		throw new \RuntimeException("Index not found");
	}

	public function getIterator(): Iterator {
		foreach ($this->streamItems as $item) {
			yield new Offer($item);
		}
	}

	public function count(): int {
		return iterator_count($this->streamItems);
	}
}
