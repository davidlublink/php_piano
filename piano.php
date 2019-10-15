<?php

namespace Lublink ;

require_once __DIR__ . '/vendor/autoload.php';

$bus = new I2C ;

$chip = new I2CChip( $bus, 0x20 );

$outputs    = [];
$inputs[]   = new MatrixIn( $chip, MatrixOut::A ) ;
$outputs[]  = new MatrixOut( $chip, MatrixOut::B ) ;

foreach ( $outputs as $output )
{
     foreach( $output as $id => $pin )
     {
          echo "Flipping $id / $pin \n";
     }
}
