<?php

namespace Log;

class FileLogger implements LoggerInterface {

	protected int $messageLimit = 80;

	protected string $filename;

	public function __construct(string $filename = "") {
		$this->filename = $filename;
	}

	public function log(string $message): void {
		$decorated = date("Y-m-d H:i:s") . PHP_EOL . $this->truncate($message) . PHP_EOL. PHP_EOL;
		file_put_contents($this->filename, $decorated, FILE_APPEND);
	}

	private function truncate(string $message): string {
		if (mb_strlen($message) > $this->messageLimit) {
			return mb_substr($message, 0, $this->messageLimit) . "...";
		}
		return $message;
	}
}
