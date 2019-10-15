<?php

namespace Lublink ;

class MatrixIn extends MCP23017Bank
{
     public function __construct( I2CChip $chip, $bank  )
     {
          parent::__construct( $chip, $bank );

          $this->set( self::IODIR, self::IN );
          
          echo 'set this bank to be Input ';
     }

     public function read()
     {
          echo 'pretend to read here ' ;

          $byte = new Byte ;

          return $byte ;
     }



}
