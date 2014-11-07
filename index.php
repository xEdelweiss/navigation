<?php

require './vendor/autoload.php';

$latitude = 46.466667;
$longitude = 30.733333;

$sphericalSystem = new xedelweiss\Navigation\CoordinateSystem\Spherical;
$sphericalSystem->setLatitude(46.466667);
$sphericalSystem->setLongitude(30.733333);
$sphericalSystem->setRadius(10);
$sphericalSystem->setAltitude(20);

echo json_encode($sphericalSystem->dump(), JSON_PRETTY_PRINT) . PHP_EOL;

$cartesianSystem = new \xedelweiss\Navigation\CoordinateSystem\Cartesian;
$cartesianSystem->importFrom($sphericalSystem);

echo json_encode($cartesianSystem->dump(), JSON_PRETTY_PRINT) . PHP_EOL;

$sphericalSystem = new \xedelweiss\Navigation\CoordinateSystem\Spherical;
$sphericalSystem->importFrom($cartesianSystem);

echo json_encode($sphericalSystem->dump(), JSON_PRETTY_PRINT) . PHP_EOL;