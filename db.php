#!/usr/bin/env php
<?php
// Include all dependencies
require_once 'vendor/autoload.php';

// Load config
require_once 'config.inc.php';
\Payutc\Config::initFromArray($_CONFIG);

// Get db link
$db = \Payutc\Db\Dbal::conn();

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($db),
    'dialog' => new \Symfony\Component\Console\Helper\DialogHelper(),
));

$cli = new \Symfony\Component\Console\Application('Doctrine Command Line Interface', Doctrine\DBAL\Version::VERSION);
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);
$cli->addCommands(array(
    // DBAL Commands
    new \Doctrine\DBAL\Tools\Console\Command\RunSqlCommand(),
    new \Doctrine\DBAL\Tools\Console\Command\ImportCommand(),
    new \Doctrine\DBAL\Tools\Console\Command\ReservedWordsCommand(),
    
    // Migrations Commands
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand(),
));
$cli->run();
