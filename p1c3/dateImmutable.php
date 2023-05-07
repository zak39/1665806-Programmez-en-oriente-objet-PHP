<?php

$date = new DateTimeImmutable();
$newDate = $date->modify('+1 day');

print($date->format('d/m/Y').PHP_EOL);
print($newDate->format('d/m/Y').PHP_EOL);
