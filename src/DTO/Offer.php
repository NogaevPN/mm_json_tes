<?php

namespace DTO;

class Offer implements OfferInterface {

	private float $price;

	private int $id;

	private string $title;

	private int $vendorId;

	public function __construct(object $data) {
		$this->id = isset($data->id) ? (int)$data->id : 0;
		$this->price = isset($data->price) ? (float)$data->price : 0;
		$this->title = isset($data->title) ? (string)$data->title : "";
		$this->vendorId = isset($data->vendorId) ? (int)$data->vendorId : 0;
	}

	public function getPrice(): float {
		return $this->price;
	}

	public function getId(): int {
		return $this->id;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function getVendorId(): int {
		return $this->vendorId;
	}

}
