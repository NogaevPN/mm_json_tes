<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FilterByVendorIdCommand extends OfferFilterCommand {

	const ARG_VENDOR_ID = "vendor_id";

	protected static $defaultName = "filter_by_vendor_id";

	protected static $defaultDescription = "Get and filter offers by vendor id";

	protected function configure(): void {
		$this->addArgument(self::ARG_VENDOR_ID, InputArgument::REQUIRED);
	}

	protected function execute(InputInterface $input, OutputInterface $output): int {
		$vendorId = $input->getArgument(self::ARG_VENDOR_ID);
		if (!is_numeric($vendorId) && !is_int($vendorId)) {
			$output->writeln(self::ARG_VENDOR_ID . " should be integer");
			return Command::INVALID;
		}

		$this->filter->vendorId = $vendorId;
		$this->logger->log("set vendor filter $vendorId");
		$this->filterAndPrintCount($output);
		return Command::SUCCESS;
	}
}
