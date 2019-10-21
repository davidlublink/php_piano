<?php

namespace Lublink  ; 

Class Note 
{
     private $number  ;
     private $buttons ;

     private $pressed = false ;

     public function __construct( $i, $buttons )/*{{{*/
     {
          $this->number = $i ;
          $this->buttons = $buttons ;
     }/*}}}*/

     public function toggle( $buttons ) /*{{{*/
     {
          foreach ( $this->buttons as $button )
          {
               $match = false ;
               foreach( $buttons as $pressed ) 
               {
                    if( $pressed->isSame( $button )) 
                    {
                         $match= true ;
                         break;
                    }

                    
               }
               if ( $match )
               {
                    continue ;
               }

               $this->set( false );
               return ; // not a match
               
          }
          $this->set( true );


     }/*}}}*/

     private function set( $position )/*{{{*/
     {
          if ( $this->pressed !== $position ) 
          {
               if ( $this->pressed ) 
                    $this->onRelease();
               else
                    $this->onPress();
          }

          $this->pressed = $position ;

     }/*}}}*/

     private function onRelease()/*{{{*/
     {
          echo 'noteff 1 '. $this->number ; 
     }/*}}}*/

     public function onPress()
     {
     echo 'noteon 1 '. $this->number .' 100' ;

     }



}
