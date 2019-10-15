<?php

namespace Lublink ;

use \Iterator as Iterator;

class MatrixOut extends MCP23017Bank implements Iterator
{
     public function __construct( I2CChip $chip, $bank  )
     {
          parent::__construct( $chip, $bank );

          $this->set( self::IODIR, self::OUT );
          
          echo 'set this bank to be Input ';
     }

     /* implement these to run through the chip, 0 -7 , activate one, disable all others */
     private $idx;
     public function current ( ) {}
     public function key ( ) {}
     public function next ( ) {}
     public function rewind ( ) {}
     public function valid ( ) {}



}
