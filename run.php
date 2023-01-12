<?php

require __DIR__."/vendor/autoload.php";

$app = new \Symfony\Component\Console\Application();
$app->add(new \Commands\GenerateJsonFileCommand());
$app->add(new \Commands\CountByVendorIdCommand());
$app->add(new \Commands\CountByPriceCommand());
$app->run();
