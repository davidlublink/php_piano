<?php

namespace Lublink ;

class MatrixIn extends MCP23017Bank
{
     public function __construct( I2CChip $chip, $bank  )
     {
          parent::__construct( $chip, $bank );

          
          echo 'set this bank to be Input ';
     }



}
