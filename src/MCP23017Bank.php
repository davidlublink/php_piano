<?php

namespace Lublink ;

Class MCP23017Bank
{
     private $banks = [ 'A' => 0, 'B' => 1 ];
     private $pins  = [ 0, 1, 2, 3, 4, 5, 6, 7 ];

     const IODIR  = 0x01 ;
     const IPOL   = 0x02;
     const GPINTEN = 0x04;

     const DEFVAL = 0x06;
     const INTCON = 0x08;
     const IOCON  = 0x0A;

     const GPPU   = 0x0C;
     const INTF   = 0x0E;
     const INTCAP = 0x10;
     const GPIO   = 0x12;
     const OLAT   = 0x14;


     const A = 'A';
     const B = 'B';


     const IN = 1;
     const OUT = 0;

     const TRUE = 1;
     const FALSE = 0;

     public function __construct( I2CChip $chip, $bank )/*{{{*/
     {
          $this->chip = $chip ;
          $this->bank = $bank ;
     }/*}}}*/

     private function getRegister( $register )/*{{{*/
     {
          return $register + $this->banks[$this->bank];
     }/*}}}*/
     
     public function set( $register, Byte $byte )/*{{{*/
     {
          return $this->chip->set( $this->getRegister( $register), $byte );
     }/*}}}*/

     public function get( $register )/*{{{*/
     {
          echo "pretending to read $register\n";
         // @todo
     }/*}}}*/

}

