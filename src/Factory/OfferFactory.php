<?php

namespace Factory;

use DTO\Offer;

class OfferFactory implements FromObjectFactoryInterface {

	public function make(object $data): Offer {
		return new Offer($data);
	}
}
