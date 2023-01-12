<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CountByPriceCommand extends OfferFilterCommand {

	const ARG_PRICE_FROM = "price_from";

	const ARG_PRICE_TO = "price_to";

	protected static $defaultName = "count_by_price_range";

	protected static $defaultDescription = "Filter and count offers by price";

	/**
	 * @inheritDoc
	 */
	protected function configure(): void {
		$this->addArgument(self::ARG_PRICE_FROM, InputArgument::REQUIRED);
		$this->addArgument(self::ARG_PRICE_TO, InputArgument::REQUIRED);
	}

	/**
	 * @inheritDoc
	 */
	protected function execute(InputInterface $input, OutputInterface $output): int {
		$priceFrom = $input->getArgument(self::ARG_PRICE_FROM);
		if (!$this->isPositiveNumber($priceFrom)) {
			$output->writeln(self::ARG_PRICE_FROM . " should be positive number");
			return Command::INVALID;
		}
		$priceTo = $input->getArgument(self::ARG_PRICE_TO);
		if (!$this->isPositiveNumber($priceTo)) {
			$output->writeln(self::ARG_PRICE_TO . " should be positive number");
			return Command::INVALID;
		}
		if ($priceTo < $priceFrom) {
			$output->writeln(self::ARG_PRICE_TO . " should be bigger than " . self::ARG_PRICE_FROM);
			return Command::INVALID;
		}

		$this->filter->priceFrom = $priceFrom;
		$this->filter->priceTo = $priceTo;
		$this->logger->log("set price range filter from $priceFrom to $priceTo");
		$this->filterAndPrintCount($output);
		return Command::SUCCESS;
	}

	private function isPositiveNumber($value): bool {
		return is_numeric($value) && $value > 0;
	}
}
