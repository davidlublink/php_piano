<?php

class FluidSynthClient
{
     private $socket = null;

     private $playing = [] ;

     public function __construct( $ip = '127.0.0.1', $port = 9800 )/*{{{*/
     {
          $this->socket = fsockopen( $ip, $port, $errno, $errstr, 30 );

          if ( $this->socket === false )
               throw new exception("$errno: $errstr");
          $this->write( 'load /usr/share/sounds/sf2/FluidR3_GM.sf2' );

     }/*}}}*/

     private function noteon( $note, $speed = 100 )/*{{{*/
     {
          $this->write( 'noteon 1 '. $note. ' '. $speed );
     }/*}}}*/

     private function noteoff( $note )/*{{{*/
     {
          $this->write( 'noteoff 1 '. $note ); 
     }/*}}}*/

     protected function write( $command )/*{{{*/
     {
          if ( false === fwrite( $this->socket, $command ."\n" ) )
               throw new Exception("Failed to write $command ");

      //    if ( "> " !== ( $r = fread( $this->socket, 2 ) ) )
        //       throw new exception("received /$r/");

     }/*}}}*/

     public function playMajorScale( $note, $pause = 500 )/*{{{*/
     {
          foreach ( $this->MajorScale as $offset )
          {
               $this->press( $note, $pause );
               $note += $offset ;
          }

          $this->press( $note, $pause * 4 );
     }/*}}}*/

     public function getNote( $note )/*{{{*/
     {
          return new FluidSynthNote( $note );
     }/*}}}*/

     public function play( FluidSynthNote $note )/*{{{*/
     {
          $this->clear();
          $this->noteon( $note->getKey() );
          $this->playing[] = $note;
     }/*}}}*/

     public function clear()/*{{{*/
     {

     }/*}}}*/
}

