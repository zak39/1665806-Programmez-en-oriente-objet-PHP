<?php

$dateUne = new DateTime();
$dateDeux = $dateUne;

$dateDeux->modify('+1 day');

var_dump([
    'dateUne' => $dateUne,
    'dateDeux' => $dateDeux,
]);

// $dateUne et $dateDeux désignent le même objet en mémoire.
// Ils sont donc tous les deux au lendemain