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

Class FluidSynthPlaying/*{{{*/
{
     private $timeout;
     private $note ;
}/*}}}*/

Class FluidSynthNote/*{{{*/
{
     private $speed = 100;
     private $accidental = 0;
     private $octave ;
     private $note ;

     private $length = 0.25 ;

     const OCTAVE = 12 ;

     const C0 = -7;

     const SCALE = [ 
               'C' => 0, 
               'D' => 2,
               'E' => 4,
               'F' => 5,
               'G' => 7,
               'A' => 9,
               'B' => 11,
               ] ;

     private $MajorScale = [ 2, 2, 1, 2, 2, 2, 1 ] ;

     public function __construct( $note )/*{{{*/
     {
          $this->octave = substr( $note, 1, 1) ;
          $this->note   = substr( $note, 0, 1) ;
     }/*}}}*/

     public function getKey()/*{{{*/
     {
          return 
          $this->octave * self::OCTAVE 
          + self::SCALE[ $this->note ]
          + self::C0
          ;
     }/*}}}*/

     public function getLength()/*{{{*/
     {
          return $this->length ;
     }/*}}}*/
     
     public function setLength( $length )/*{{{*/
     {
          $this->length = $length;

          return $this ;
     }/*}}}*/

}/*}}}*/

$piano = new FluidSynthClient;

$c = $piano->getNote( 'C4' );
$e = $piano->getNote( 'E4' );
$g = $piano->getNote( 'G4' );
$c5= $piano->getNote( 'C5' );

$piano->play( $c ); 
usleep(500000);
$piano->play( $e ); 
usleep(500000);
$piano->play( $g ); 
usleep(500000);
$piano->play( $c5 ); 

sleep(1);
