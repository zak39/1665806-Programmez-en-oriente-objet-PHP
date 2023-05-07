<?php

// D'abord, l'exemple sans chainage :
$date = new DateTime();
$newDate = $date->modify('+1 day');

print($date->format('d/m/Y').PHP_EOL);
print($newDate->format('d/m/Y').PHP_EOL);

// Maintenant avec le chainage. Nous exploitons directement
// l'objet qui nous est retourné sans le stocker dans une variable :
$formatDate = $date->modify('+1 day')->format('d/m/y');
print($formatDate.PHP_EOL);
