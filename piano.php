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
          foreach ( $inputs as $input )
          {
               $byte = $input->read();

               if( $byte->isNonZero() )
                    echo "Output $id matched with input {$byte->getInteger()}\n";
               else
                    echo "No input detected\n";
          }

     }
     echo "Clearing outputs on current chip\n";
     $output->clear();
}
