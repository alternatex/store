<?php namespace Store\Server;

/**
* Socket Server
*
* @class SocketServer
* @constructor
*/
class SocketServer extends DefaultServer {

	const SERVER_DEFAULT_HOST = 'localhost';
	const SERVER_DEFAULT_PORT = 7777;
	
	private $host = null;
	private $port = null;

	public function __construct($host=SERVER_DEFAULT_HOST, $port=SERVER_DEFAULT_PORT){
		$this->host = $host;
		$this->port = $port;
	}
}