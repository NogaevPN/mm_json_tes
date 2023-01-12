<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generating json file to test memory consumption,
 * This command requires high amount of memory!
 */
class GenerateJsonFileCommand extends OfferFilterCommand {

	/**
	 * Count of rows in generated file
	 */
	const ROWS = 1000000;

	protected static $defaultName = "generate";

	protected static $defaultDescription = "Generate json file with pseudo random values";

	/**
	 * @inheritDoc
	 */
	protected function execute(InputInterface $input, OutputInterface $output): int {
		$ar = [];
		for ($i = 0; $i < self::ROWS; $i++) {
			$ar[] = [
				"offerId" => 1000 + $i,
				"productTitle" => "title$i",
				"vendorId" => mt_rand(1, 30),
				"price" => mt_rand(5, 200),
			];
		}
		file_put_contents($this->sourceUrl, json_encode($ar));
		return Command::SUCCESS;
	}
}
