<?php

namespace DTO;

class OfferFilter {

	public ?float $priceFrom = null;

	public ?float $priceTo = null;

	public ?int $vendorId = null;

	public function getCount(OfferCollectionInterface $collection): int {
		$count = 0;
		foreach ($collection->getIterator() as $offer) {
			if ($this->isOfferMatchCriteria($offer)) {
				$count++;
			}
		}
		return $count;
	}

	private function isOfferMatchCriteria(OfferInterface $offer): bool {
		return ! $this->isOfferDontMatchesCriteria($offer);
	}

	private function isOfferDontMatchesCriteria(OfferInterface $offer): bool {
		return ($this->vendorId && $offer->getVendorId() !== $this->vendorId) ||
			($this->priceFrom && $offer->getPrice() < $this->priceFrom) ||
			($this->priceTo && $offer->getPrice() > $this->priceTo);
	}
}
