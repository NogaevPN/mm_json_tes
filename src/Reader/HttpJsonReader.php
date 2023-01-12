<?php

namespace Reader;

use DTO\OfferCollectionInterface;
use DTO\OffersCollection;
use Factory\FromObjectFactoryInterface;
use Log\LoggerInterface;

class HttpJsonReader implements ReaderInterface {

	private LoggerInterface $logger;

	private FromObjectFactoryInterface $factory;

	public function __construct(LoggerInterface $logger, FromObjectFactoryInterface $factory) {
		$this->logger = $logger;
		$this->factory = $factory;
	}

	public function read(string $input): OfferCollectionInterface {
		$content = $this->getContentFromHttp($input);
		return $this->parseContent($content);
	}

	private function parseContent(string $content): OfferCollectionInterface {
		$items = json_decode($content);
		if (empty($items)) {
			$errorMessage = json_last_error_msg();
			if ($errorMessage) {
				$this->logger->log("Error parsing json: $errorMessage");
			}
		}
		$items = json_decode($content);
		$parsedItems = is_array($items) ? $this->parseItems($items) : [];
		return new OffersCollection($parsedItems);
	}

	private function getContentFromHttp(string $input): string {
		$this->logger->log("read from $input");
		$content = file_get_contents($input);
		$this->logger->log("received $content");
		return (string)$content;
	}

	private function parseItems(array $items): array {
		$parsed = [];
		foreach ($items as $item) {
			if (is_object($item)) {
				$parsed[] = $this->factory->make($item);
			}
		}
		return $parsed;
	}
}

