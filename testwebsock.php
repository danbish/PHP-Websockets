#!/usr/bin/env php
<?php

require_once( './websockets.php' );

class echoServer extends WebSocketServer 
{
  //protected $maxBufferSize = 1048576; //1MB... overkill for an echo server, but potentially plausible for other applications.
  
  /**
   * Called immediately when the data is recieved.
   * Defined as an acstract in websocket server
   */
  protected function process ( $user, $message ) 
  {
    $this->send($user,$message);
  }
  
/* just working on this - src: http://www.abrandao.com/2013/06/25/websockets-using-modern-html5-technology-for-true-server-push/
function process($user,$msg){
  $action = unwrap($msg);
  say("< ".$action);
  switch($action){
    case "hello" : send($user->socket,"hello human"); break;
    case "hi" : send($user->socket,"zup human"); break;
    case "name" : send($user->socket,"my name is Multivac, silly I know"); break;
    case "age" : send($user->socket,"I am older than time itself"); break;
    case "date" : send($user->socket,"today is ".date("Y.m.d")); break;
    case "time" : send($user->socket,"server time is ".date("H:i:s")); break;
    case "thanks": send($user->socket,"you're welcome"); break;
    case "bye" : send($user->socket,"bye"); break;
    default : send($user->socket,$action." not understood"); break;
  }
}*/
  
  
  /**
   * Called after the handshake response is sent to the client.
   * Defined as an acstract in websocket server
   */
  protected function connected ( $user ) 
  {
    // Do nothing: This is just an echo server, there's no need to track the user.
    // However, if we did care about the users, we would probably have a cookie to
    // parse at this step, would be looking them up in permanent storage, etc.
  }
  
  /**
   * Called after the connection is closed.
   * Defined as an acstract in websocket server
   */
  protected function closed ( $user ) 
  {
    // Do nothing: This is where cleanup would go, in case the user had any sort of
    // open files or other objects associated with them.  This runs after the socket 
    // has been closed, so there is no need to clean up the socket itself here.
  }
}

$oSocketSrvr = new echoServer( "0.0.0.0", "9000" );

try 
{
  $oSocketSrvr->run();
}
catch ( Exception $oE ) 
{
  $oSocketSrvr->stdout( $oE->getMessage() );
}
