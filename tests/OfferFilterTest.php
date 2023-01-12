<?php

use DTO\OfferFilter;
use DTO\OffersCollection;
use PHPUnit\Framework\TestCase;

class OfferFilterTest extends TestCase {

	private function getSampleVendorId(): int {
		return random_int(1, 100);
	}

	public function testGetMatchedVendorId() {
		$vendorId = $this->getSampleVendorId();
		$filter = $this->getFilterByVendorId($vendorId);
		$collection = $this->getCollectionOfOneOfferWithVendorId($vendorId);
		$this->assertEquals(1, $filter->getCount($collection));
	}

	public function testNoMatches() {
		$vendorId = $this->getSampleVendorId();
		$filter = $this->getFilterByVendorId($vendorId);
		$collection = $this->getCollectionOfOneOfferWithVendorId($vendorId + 1);
		$this->assertEmpty($filter->getCount($collection));
	}

	public function testCountMatches() {
		$vendorId = $this->getSampleVendorId();
		$filter = $this->getFilterByVendorId($vendorId);
		$collection = $this->getCollectionOfOneOfferWithVendorId($vendorId);
		$this->assertEquals(1, $filter->getCount($collection));
	}

	public function testCountNoMatches() {
		$vendorId = $this->getSampleVendorId();
		$filter = $this->getFilterByVendorId($vendorId);
		$collection = $this->getCollectionOfOneOfferWithVendorId($vendorId + 1);
		$this->assertEquals(0, $filter->getCount($collection));
	}


	private function getFilterByVendorId(int $vendorId): OfferFilter {
		$filter = new OfferFilter();
		$filter->vendorId = $vendorId;
		return $filter;
	}

	private function getCollectionOfOneOfferWithVendorId(int $vendorId): OffersCollection {
		$offer = new \DTO\Offer((object)["vendorId" => $vendorId]);
		return new OffersCollection([$offer]);
	}
}
