<?php
require __DIR__."/vendor/autoload.php";

use Symfony\Component\Console\Application;
use ASPTest\Views\Console\UserCreateCommand;
use ASPTest\Views\Console\UserCreatePwdCommand;

$asptest = new Application("ASP-Test", "version 0.0.1");
$asptest->add(new UserCreateCommand());
$asptest->add(new UserCreatePwdCommand());
$asptest->run();


