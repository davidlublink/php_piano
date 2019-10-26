<?php

namespace Lublink;

use \Exception ;

Class Byte
{
     private $byte = 0;

     public function __construct( $value = null )/*{{{*/
     {
          $this->byte = $value ;
     }/*}}}*/

     public function setBit( $idx, $value )/*{{{*/
     {
          if ( $value ) 
               $this->byte |= pow( 2, $idx );
          else
               $this->byte &= pow( 2, $idx );
     }/*}}}*/

     public function setInteger( $value )/*{{{*/
     {
          $this->byte = $value ;
     }/*}}}*/

     public function getInteger( )/*{{{*/
     {
          return $this->byte ;
     }/*}}}*/

     public function getChar( )/*{{{*/
     {
          return chr( $this->byte ); 
     }/*}}}*/

     public function setHex( $hex )/*{{{*/
     {
          $this->byte = base_convert( $hex, 16, 10 ) ;
     }/*}}}*/

     public function getHex( $hex )/*{{{*/
     {
          return base_convert( $this->byte, 10, 16 ) ;
     }/*}}}*/

     public function getBit( $idx )/*{{{*/
     {
          return 0 !== ( $this->byte & pow( 2, $idx ) );
     }/*}}}*/

     public function isNonZero()/*{{{*/
     {
          return $this->byte > 0 ;
     }/*}}}*/

     public function getActiveBits()/*{{{*/
     {
          $r = [] ;
          for ( $i = 0; $i < 8 ; $i++ )
               $r[$i] = 0 !== ( $this->byte & pow(2,$i) );

          return $r; 
     }/*}}}*/

}
