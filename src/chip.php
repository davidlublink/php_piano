<?php


class I2CChip
{

     public function __construct( I2C $i2c, $address )/*{{{*/
     {
          $this->i2c = $i2c;
          $this->address = $address ; 
     }/*}}}*/

     public function read( $register )/*{{{*/
     {
          return $this->i2c->read( $this->address, $register ) ;
     }/*}}}*/

     public function write( $register, Byte $byte )/*{{{*/
     {
          return $this->i2c->write( $this->address, $register, $byte ) ;
     }/*}}}*/

}
