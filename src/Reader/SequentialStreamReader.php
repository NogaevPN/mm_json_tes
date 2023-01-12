<?php

namespace Reader;

use DTO\OfferCollectionInterface;
use DTO\SequentialReadOfferCollection;
use JsonMachine\Items;

class SequentialStreamReader implements ReaderInterface {

	public function read(string $input): OfferCollectionInterface {
		$items = Items::fromFile($input);
		return new SequentialReadOfferCollection($items);
	}
}
