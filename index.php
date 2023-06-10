<?php

declare(strict_types=1);

require_once('./Admin.php');

$admin = new Admin('Paddington');
$admin->setStatus(Admin::STATUS_LOCKED);
print($admin->getStatus());
print("\n");
