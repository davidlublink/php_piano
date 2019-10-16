<?php

namespace Lublink ;

require_once __DIR__ . '/vendor/autoload.php';

$bus = new I2C ;

$chip = new I2CChip( $bus, 0x20 );

$outputs    = [];
$inputs[]   = $r = new MatrixIn( $chip, MatrixOut::A ) ;
$r->disablePins( 4, 5, 6, 7 );

$outputs[]  = $r = new MatrixOut( $chip, MatrixOut::B ) ;
$r->disablePins( 4, 5, 6, 7 );


$matrix = [
     [ '1', '2', '3', 'A'],
     [ '4', '5', '6', 'B'],
     [ '7', '8', '9', 'B'],
     [ '*', '0', '#', 'B'],

     ];

foreach ( $outputs as $output )
{
     foreach( $output as $col => $pin )
     {
          foreach ( $inputs as $input )
          {
               $byte = $input->read();

               foreach ( $byte as $row )
               {
                    echo "============> $col x $row  <==========\n";
                    //echo "\n\n\n\n============> ". $matrix[ $row ] [ $col ]."<========== \n\n\n";
               }
          }

     }
     $output->clear();
}
