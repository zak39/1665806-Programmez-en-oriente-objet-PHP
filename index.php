<?php

require_once('./Admin.php');
require_once('./Player.php');
require_once('./SuperAdmin.php');
require_once('./User.php');

/**
 * Output: Uncaught Error: Cannot instantiate abstract class User
 */
//$user = new User();

$player = new Player('imagine@hotmail.fr', 'imagine');
print($player->getUsername() . PHP_EOL);

$admin = new Admin('zak@hotmail.com', 'zak');
print($admin->getUsername() . PHP_EOL);
