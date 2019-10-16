<?php

namespace Lublink ;

class MatrixIn extends MCP23017Bank
{

     public function __construct( I2CChip $chip, $bank  )/*{{{*/
     {
          parent::__construct( $chip, $bank );

          $byte = new Byte ;
          for ( $i = 0; $i < 8 ; $i++ )
               $byte->setBit( $i, self::IN ); 

          $this->write( self::IODIR, $byte );
     }/*}}}*/

     public function read()/*{{{*/
     {
          return parent::read( self::GPIO )->getActiveBits();
     }/*}}}*/



}
