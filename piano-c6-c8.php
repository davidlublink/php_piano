<?php

namespace Lublink ;

use \Exception ;


require_once __DIR__ . '/vendor/autoload.php';

$piano = new Decoder ;

$chip = new I2CChip( new I2C, 0x20 );

$piano->add( new MatrixOut( $chip, MatrixOut::B )); 
$piano->add( new MatrixIn( $chip, MatrixOut::A ) ); 

$cal = new Calibrate( $piano ); 
$cal->calibrate();

$cal->setSynth( new FluidSynthClient( '192.168.34.112' ) ); 

$cal->run() ;

