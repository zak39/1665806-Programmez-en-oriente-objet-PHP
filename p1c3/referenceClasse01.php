<?php

// déclaration de référence à l'objet
function foo(DateTime $date) {
    $date->modify('+1 day'); // permet d'ajouter 1 jour à la date
}

$date = new DateTime();

var_dump([
    'before' => $date
]);

foo($date);

var_dump([
    'after' => $date
]);

// $date est maintenant au lendemain