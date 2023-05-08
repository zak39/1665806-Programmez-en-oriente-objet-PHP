<?php

// Même en déclarant le type strict, cela ne nous sauvera pas.
declare(strict_types=1);

// L'opération aura bien lieu mais on aura un
// problème comme quoi il y a des valeurs numériques.
// Donc attention à bien typer nos variables.
var_dump('1Acarré' + '2Ab');