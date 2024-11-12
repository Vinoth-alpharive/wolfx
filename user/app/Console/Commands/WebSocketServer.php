<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\Socket\Server;
use React\Socket\SecureServer;
use App\Http\Controllers\SocketController;

class WebSocketServer extends Command
{

    protected $signature = 'websocket:init';


    protected $description = 'Command description';

    public function handle()
    {
        $app = new HttpServer(
            new WsServer(
                new SocketController()
            )
        );

        $loop = Factory::create();

        $secure_websockets = new Server('64.23.137.103:8090', $loop);
        $secure_websockets = new SecureServer($secure_websockets, $loop, [
            'local_cert' => '/home/admin/web/ssl/crt.pem',
            'local_pk' => '/home/admin/web/ssl/key.pem',
            'allow_self_signed' => FALSE, // Allow self signed certs (should be false in production)
            'verify_peer' => FALSE
        ]);

        $secure_websockets_server = new IoServer($app, $secure_websockets, $loop);
        $secure_websockets_server->run();
    }
}
