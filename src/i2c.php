<?php

namespace Lublink;

Class I2C
{

     public function __construct( $bus )/*{{{*/
     {
          $this->bus = $bus ;
     }/*}}}*/

     public function write ( $chip, $register, Byte $byte )/*{{{*/
     {
          $e = "i2cset -y {$this->bus} 0x".dechex($chip) . " 0x". dechex($register) . ' 0x' . dechex( $byte->getDecimal() ) ;

          //echo $e ."\n";

          shell_exec( $e );

     }/*}}}*/

     public function read( $chip, $register)/*{{{*/
     {
          $e = "i2cget -y {$this->bus} 0x". dechex( $chip)." 0x". dechex($register) ;

          // echo $e ."\n";

          $byte = new Byte;
          $byte->fromShell( trim(shell_exec( $e )) );

          return $byte; 
     }/*}}}*/

}
