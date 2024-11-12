<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TicketChat;



class Tickets extends Model
{   

        protected $connection = 'mysql2';
    protected $table = 'supporttickets';

    public static function index()
    {
        $tickets = Tickets::on('mysql2')
        ->join('users', 'supporttickets.uid', '=', 'users.id')
        ->select('supporttickets.*','users.first_name','users.last_name','users.email')
        ->orderBy('id','desc')->paginate(10);
        return $tickets;
    }


    
    // public static function images()
    // {
    //     // Ensure the table names and database connection are correct
    //     $image = Tickets::on('mysql2') // Use the correct connection
    //     ->table('supporttickets') // Assuming the table name is 'tickets'
    //     ->join('support_ticket_images', 'supporttickets.ticket_id', '=', 'support_ticket_images.ticket_id')
    //     ->select('supporttickets.*', 'support_ticket_images.image')
    //     ->orderBy('supporttickets.id', 'desc')
    //         ->paginate(10);

    //     return $image;
    // }

    public function admin_unreadmsg($ticketid)
    {
        $admin_unreadmsg = TicketChat::where(['ticketid' => $ticketid,'admin_status' => 0])->count();
        return $admin_unreadmsg;
    }
    

}
