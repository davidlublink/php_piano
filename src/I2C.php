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
          $e = "i2cset -y {$this->bus} ".$this->toHex($chip) . " ". $this->toHex($register->getInteger()) . ' ' . $this->toHex( $byte->getInteger() ) ;

          exec( $e ) ; 

     }/*}}}*/

     private function toHex( $decimal )/*{{{*/
     {
          return '0x'.str_pad( base_convert( $decimal, 10, 16 ), 2, '0',  STR_PAD_LEFT ) ;
     }/*}}}*/

     public function read( $chip, $register)/*{{{*/
     {
          $e = "i2cget -y {$this->bus} ". $this->toHex( $chip)." ". $this->toHex($register->getInteger() ) ;

          $byte = new Byte;

          exec( $e, $output, $exit ); 

          $r = $output[0];

          if ( $exit !== 0 )
               throw new exception("$e failed");

          if ( strlen( $r ) !== 4 )
               throw new \Exception($r);

          $byte->setHex( $r ) ;

          return $byte; 
     }/*}}}*/

}
