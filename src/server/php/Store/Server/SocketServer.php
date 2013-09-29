<?php namespace Store\Server;

/**
* Socket Server
*
* @class SocketServer
* @constructor
*/
class SocketServer extends DefaultServer {

	const DEFAULT_HOST = '127.0.0.1';
	const DEFAULT_PORT = 8080;
	
	private $host = null;
	private $port = null;

	public function __construct($host=SocketServer::DEFAULT_HOST, $port=SocketServer::DEFAULT_PORT){
		$this->host = $host;
		$this->port = $port;
	}
}