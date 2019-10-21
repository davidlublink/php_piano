<?php

namespace Lublink ;

use \Exception ;

class Calibrate
{
     private $path ;

     CONST OFFSET = 40 ;
     CONST KEYS = 7;

     private $notes = [] ; 

     public function __construct( Decoder $decoder, $path = 'php://stdout' )/*{{{*/
     {
          $this->decoder = $decoder;
          $this->path = $path ;

          if ( file_exists('/tmp/calibrate-phppiano' ) )
          {
               $this->notes = unserialize( file_get_contents( '/tmp/calibrate-phppiano' ) );
          }
     }/*}}}*/

     public function calibrate()/*{{{*/
     {
          for ( $i = self::OFFSET; $i <= self::OFFSET + self::KEYS ; $i++ )
          {
               if ( array_key_exists( $i, $this->notes ) ) continue ;
               $this->notes[ $i ] = $this->findKey( $i );

               file_put_contents('/tmp/calibrate-phppiano', serialize( $this->notes )) ; 
          }

     }/*}}}*/

     private function findKey($i )/*{{{*/
     {
          echo 'hold key '. $i . " and hold it until I saw it's ok!\n\n";
          while ( count( $buttons = $this->decoder->getPressedButtons() ) !== 2 ) ; 

          echo "Release all keys\n";
          while ( count( $buttons = $this->decoder->getPressedButtons()  ) > 0 ); 

          usleep( 1000000 ); 

          return new Note( $i, $buttons ) ;
     }/*}}}*/

     public function run()/*{{{*/
     {
          while ( true )
          {
               $keys = $this->decoder->getPressedButtons();
               if ( count( $keys ) )
               {
                    print_r($keys) ;
               }
               continue;
               foreach ( $this->notes as $note )
               {
                    $note->toggle( $keys ) ;
               }
          }
     }/*}}}*/

}


