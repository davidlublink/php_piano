<?php

namespace Lublink;

Class I2C
{

     public function __construct( $bus = 1 )/*{{{*/
     {
          $this->bus = $bus ;
     }/*}}}*/

     public function write ( $chip, $register, Byte $byte )/*{{{*/
     {
          $e = "i2cset -y {$this->bus} ".$this->toHex($chip) . " ". $this->toHex($register) . ' ' . $this->toHex( $byte->getInteger() ) ;

          echo $e ."\n";

          //shell_exec( $e );

     }/*}}}*/

     private function toHex( $decimal )/*{{{*/
     {
          return '0x'.str_pad( base_convert( $decimal, 10, 16 ), 2, '0',  STR_PAD_LEFT ) ;
     }/*}}}*/

     public function read( $chip, $register)/*{{{*/
     {
          $e = "i2cget -y {$this->bus} 0x". $this->toHex( $chip)." 0x". $this->toHex($register) ;

          echo $e ."\n";

          $byte = new Byte;
          $byte->setHex( 0x22 );
          //$byte->setHex( trim(shell_exec( $e )) );

          return $byte; 
     }/*}}}*/

}
