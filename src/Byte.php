<?php

namespace Lublink;

use \Exception ;

Class Byte
{
     private $byte = '00000000' ;
     const DEF = '00000000' ;

     public function __construct( $value = null )/*{{{*/
     {
          if ( is_int( $value ) )
               $this->setInteger( $value );
          elseif ( $value === null )
               ;
          else
               throw new Exception("Unable to handle $value");

     }/*}}}*/

     public function setBit( $idx, $value )/*{{{*/
     {
          if ( $idx > 7 || $idx < 0 )
               throw new Exception("Bad bit");

          $this->byte[ $idx ] = $value ;
     }/*}}}*/

     public function setInteger( $value )/*{{{*/
     {
          $this->byte = str_pad(base_convert( $value, 10, 2 ), 8, '0', STR_PAD_LEFT );

     }/*}}}*/

     public function getInteger( )/*{{{*/
     {
          return base_convert( $this->byte, 2, 10 );
     }/*}}}*/

     public function setHex( $hex )/*{{{*/
     {
          $this->byte = str_pad( base_convert( $hex, 16, 2 ), 8, '0', STR_PAD_LEFT );
     }/*}}}*/

     public function getBit( $idx )/*{{{*/
     {
          if ( $idx > 7 || $idx < 0 )
               throw new Exception("Bad bit");

          return '1' === $this->byte[ $idx ] ;
     }/*}}}*/

     public function isNonZero()/*{{{*/
     {
          return self::DEF !== $this->byte;
     }/*}}}*/

     public function getActiveBits()/*{{{*/
     {
          $r = [] ;
          for ( $i = 0; $i < strlen( $this->byte ); $i++ )
               if ( $this->getBit( $i ) )
                    $r[$i] = $i ;

          return $r ;
     }/*}}}*/

}
