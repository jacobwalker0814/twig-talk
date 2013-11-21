<?php

require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views/');
$twig   = new Twig_Environment($loader);

function someCode() { return "Twig"; }

echo $twig->render('index.html.twig', ['engine' => someCode()]);
