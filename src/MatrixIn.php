<?php

namespace Lublink ;

class MatrixIn extends MCP23017Bank
{
     public function __construct( I2CChip $chip, $bank  )/*{{{*/
     {
          parent::__construct( $chip, $bank );

          $this->write( self::IODIR, new Byte( 0xff ) );

     }/*}}}*/

     public function read()/*{{{*/
     {
          return array_intersect( $this->getPins() , parent::read( self::GPIO )->getActiveBits() );
     }/*}}}*/



}
