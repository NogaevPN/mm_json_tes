<?php

namespace Log;

interface LoggerInterface {

	public function log(string $message): void;
}
