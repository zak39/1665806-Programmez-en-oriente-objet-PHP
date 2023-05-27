<?php

require('Admin.php');
require_once('User.php');

$user = new User('zak');
$user->setStatus('inactive');
print($user->getStatus() . PHP_EOL);

$admin = new Admin('admin');
print_r($admin->getRoles());
$admin->addRole('');
print_r($admin->getRoles());
