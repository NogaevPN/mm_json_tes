<?php

namespace Commands;

use DTO\OfferFilter;
use Factory\OfferFactory;
use Log\FileLogger;
use Log\LoggerInterface;
use Reader\HttpJsonReader;
use Reader\ReaderInterface;
use Reader\SequentialStreamReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

class OfferFilterCommand extends Command {

	protected OfferFilter $filter;

	protected ReaderInterface $reader;

	protected LoggerInterface $logger;

	/**
	 * Test file location
	 *
	 * @var string
	 */
	protected string $sourceUrl = __DIR__ . "/../../test.json";

	public function __construct(string $name = null) {
		$this->logger = new FileLogger("processing.log");
		/*
		 *  simple reader with logging
		$this->reader = new HttpJsonReader($this->logger, new OfferFactory());
		*/
		$this->reader = new SequentialStreamReader();
		$this->filter = new OfferFilter();
		parent::__construct($name);
	}

	protected function filterAndPrintCount(OutputInterface $output): void {
		$started = microtime(true);
		$collection = $this->reader->read($this->sourceUrl);
		$count = $this->filter->getCount($collection);
		$this->logger->log("Filtered to $count");
		$output->writeln($count);
		$output->writeln("Memory " . round(memory_get_peak_usage() / 1024 / 1024, 2) . " MB");
		$output->writeln("took " . round(microtime(true) - $started, 3) . " seconds");
	}
}
