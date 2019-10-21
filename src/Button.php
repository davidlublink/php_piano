<?php

namespace Lublink ;

use \Exception ;

Class Button
{
     private $X ;
     private $Y ;

     public function __construct( $x, $y )/*{{{*/
     {
          $this->X = $x;
          $this->Y = $y;
     }/*}}}*/

     public function getX()/*{{{*/
     {
          return $this->X ;
     }/*}}}*/

     public function getY()
     {
          return $this->Y;
     }

     public function isSame( Button $button )
     {
          return $button->X === $this->X && $button->Y === $this->Y ;
     }
}

