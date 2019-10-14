<?php

Class Byte
{
     private $byte = '00000000' ;

     public function setBit( $idx, $value )/*{{{*/
     {
          if ( $idx > 7 || $idx < 0 )
               throw new Exception("Bad bit");

          $this->byte[ $idx ] = $value ;
     }/*}}}*/

}
