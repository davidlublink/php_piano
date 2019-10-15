<?php

namespace Lublink ;

use \Iterator as Iterator;

class MatrixOut extends MCP23017Bank implements Iterator
{

     public function __construct( I2CChip $chip, $bank  )/*{{{*/
     {
          parent::__construct( $chip, $bank );

          $this->write( self::IODIR, new Byte( self::OUT ) ) ;
          $this->write( self::GPPU, new Byte( 0xff ) ); 


          $this->rewind() ;
     }/*}}}*/

     /* implement these to run through the chip, 0 -7 , activate one, disable all others */
     private $idx = 0 ;
     public function current ( ) 
     {

          return $this->idx ;
     }

     public function key ( ) /*{{{*/
     {
          return $this->idx ;
     }/*}}}*/

     public function next ( ) /*{{{*/
     {
          $this->idx = $this->idx + 1 ;

          $this->write( self::OLAT, new Byte( pow( 2, $this->idx ) ) );

          return $this->idx;
     }/*}}}*/

     public function rewind ( ) /*{{{*/
     {
          $this->idx = -1 ;
          $this->next();
     }/*}}}*/

     public function valid ( ) /*{{{*/
     {
          return $this->idx < 8 && $this->idx >= 0; 
     }/*}}}*/



}
