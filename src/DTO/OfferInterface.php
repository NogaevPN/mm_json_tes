<?php

namespace DTO;

/**
 * Interface of Data Transfer Object, that represents external JSON data
 */
interface OfferInterface {

	public function getPrice(): float;

	public function getVendorId(): int;

	public function getTitle(): string;

	public function getId(): int;
}

