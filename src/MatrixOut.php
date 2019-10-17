<?php

namespace Lublink ;

use \Iterator as Iterator;

class MatrixOut extends MCP23017Bank implements Iterator
{

     public function __construct( I2CChip $chip, $bank  )/*{{{*/
     {
          parent::__construct( $chip, $bank );

          $this->write( self::IODIR, new Byte( 0x00 ) );
          $this->write( self::GPPU, new Byte( 0xff ) ); 

     }/*}}}*/

     /* implement these to run through the chip, 0 -7 , activate one, disable all others */
     private $idx = 0 ;

     public function current ( ) /*{{{*/
     {
          $this->write( self::OLAT, new Byte( 255 - pow( 2, $this->idx ) ) );
          return $this->idx ;
     }/*}}}*/

     public function key ( ) /*{{{*/
     {
          return $this->idx ;
     }/*}}}*/

     public function next ( ) /*{{{*/
     {
          $this->idx = $this->idx + 1 ;
     }/*}}}*/

     public function rewind ( ) /*{{{*/
     {
          $this->idx = 0;
     }/*}}}*/

     public function valid ( ) /*{{{*/
     {
          return array_key_exists( $this->idx, $this->getPins() ) ;
     }/*}}}*/

     public function clear()/*{{{*/
     {
          $this->write( self::OLAT, new Byte( 0x00 ) ); 
     }/*}}}*/


}
