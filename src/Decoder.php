<?php

namespace Lublink ;

use \Exception ;

Class Decoder
{
     private $Inputs = [] ;
     private $Outputs = [];

     public function add( MCP23017Bank $bank )/*{{{*/
     {
          if ( $bank instanceOf MatrixOut )
               $this->Outputs[] = $bank ;
          elseif ( $bank instanceOf MatrixIn )
               $this->Inputs[] = $bank ;
          else
               throw new \Exception( "Unsupported class ") ;
     }/*}}}*/

     public function getPressedButtons()/*{{{*/
     {
          $keys= []; 
          foreach ( $this->Outputs as $output )
          {
               foreach( $output as $col => $pin )
               {
                    foreach ( $this->Inputs as $input )
                    {
                         $byte = $input->read();

                         foreach ( $byte as $row )
                         {
                              $keys[] = new Button( $row, $col ) ;
                         }
                    }

               }
               $output->clear();
          }

          return $keys ;
     }/*}}}*/

}

