<?php
/**
 * With this script I connected a 4x4 keypad as follows
 *
 * GPIO-B 0 x1
 * GPIO-B 1 x2
 * GPIO-B 2 x3
 * GPIO-B 3 x4
 * GPIO-A 0 y1
 * GPIO-A 1 y2
 * GPIO-A 2 y3
 * GPIO-A 3 y4
 */

namespace Lublink ;

require_once __DIR__ . '/vendor/autoload.php';

$bus = new I2C ;

$chip = new I2CChip( $bus, 0x20 );

$outputs    = [];
$outputs[]  = $r = new MatrixOut( $chip, MatrixOut::B ) ; 
$r->disablePins( 5,6,7 );

$inputs = [];
$inputs[]   = $r = new MatrixIn( $chip, MatrixOut::A ) ;
$r->disablePins( 4,5,6,7 );



$matrix = [
     [ '1', '2', '3', 'A'],
     [ '4', '5', '6', 'B'],
     [ '7', '8', '9', 'C'],
     [ '*', '0', '#', 'D'],

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
                    echo '====> '. $matrix[$col][$row]."\n";
               }
          }

     }
     $output->clear();
}