<?php

namespace Lublink ;

/**
 * @ todo This uses calls to shell_exec which invokes a shell and an external process ( create and destroys ). This is slow. It will be ok for the prototype sofware
 * but I strongly suspect that the shell/process problem will become a bottle neck
 *
 */

class I2C
{
     private $chip ;

     public function __construct( $bus, $address )/*{{{*/
     {
          $this->bus = $bus;
          $this->address = $address ;
     }/*}}}*/
     public function __toString()/*{{{*/
     {
          return 'xxxx> ' . $this->address. ' <xxxx';;
     }/*}}}*/
     
     public function set( $register, $value )/*{{{*/
     {
          $e = "i2cset " 
               . '-y '
               . $this->bus 
               . ' 0x'
               . str_pad( base_convert( $this->address, 10, 16 ), 2, '0' )
               . ' 0x'
               . str_pad( base_convert( $register, 10, 16 ), 2, '0' )
               . ' 0x'
               . str_pad( base_convert( $value, 2, 16 ), 2, '0' )
               ;
          return shell_exec( $e );
     }/*}}}*/

     public function get( $register )/*{{{*/
     {
          $e = "i2cget " 
               . '-y '
               . $this->bus 
               . ' 0x'
               . str_pad( base_convert( $this->address, 10, 16 ), 2, '0' )
               . ' 0x'
               . str_pad( base_convert( $register, 10, 16 ), 2, '0' )
               ;
          return hexdec(  trim( shell_exec( $e ) )) ;
     }/*}}}*/
}


