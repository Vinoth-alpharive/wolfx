<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tickets;
use App\Models\TicketChat;
use App\Models\User;
use App\Mail\TicketSentUser;
use App\Models\Subscriber;
use App\Models\SupportTicket;

use App\Models\Contact;
use Validator;

class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $support = Tickets::index();

      


        return view('support.list', [
            'tickets' => $support
        ]);
    }


    public static function getSupportTicketsWithImages()
    {
        $supportTicketsWithImages = SupportTicket::on('mysql2') // Assuming 'mysql2' is the correct connection
        ->with('images')
        ->orderByDesc('id')
            ->paginate(10);


        // dd($supportTicketsWithImages);


        return
        view('support.list', [
            'supportTicketsWithImages' => $supportTicketsWithImages
        ]);
       

        
        
    }





    public function subscriber()
    {

        $listall = Subscriber::paginate(15);

        return view('subscriber.subscriber', [
            'listall' => $listall
        ]);
    }

    public function subscriberdelete($id)
    {

        $id  = \Crypt::decrypt($id);
        $listall = Subscriber::on('mysql2')->where('id', $id)->delete();

        return back()->with('status', 'Deleted Successfully');
    }


    public function contactus()
    {


        $listall = Contact::contact_view();

        return view('contactus', [
            'listall' => $listall
        ]);
    }
    public function contactremove($id)
    {
        $id  = \Crypt::decrypt($id);
        $delete = Contact::on('mysql2')->where('id', $id)->delete();

        return back()->with('contactuserupdate', 'Deleted Successfully');
    }



    public function reply($id)
    {

        $id = \Crypt::decrypt($id);
        // dd($id);
        $chatlist = TicketChat::on('mysql2')->where('ticketid', $id)->get();
        $userid = $chatlist[0]->uid;
        $userlist = User::where('id', $userid)->first();

        TicketChat::where('ticketid', $id)->update(['admin_status' => 1]);

        return view('support.reply', [
            'chatlist' => $chatlist,
            'username' => $userlist->name,
            'userlist' => $userlist,
            'ticket_id' => $id,
        ]);
    }

    public function adminsavechat(Request $request)
    {

        $message     = $request->message;
        $chat_id     = $request->chat_id;
        $userid       = $request->userid;
        //dd($userid);

        if ($message != "" && $chat_id != "" && $userid  != "") {

            $ticketChat = new TicketChat;
            $ticketChat->uid = $userid;
            $ticketChat->ticketid = $chat_id;
            $ticketChat->message = NULL;
            $ticketChat->reply = $message;
            $ticketChat->user_status = 0;
            $ticketChat->admin_status = 1;

            if ($ticketChat->save()) {
                TicketChat::where('ticketid', $chat_id)->update(['admin_status' => 1]);
                $userEmail = User::where('id', $userid)->first();
                $email = $userEmail->email;

                // \Mail::to($userEmail->email)->queue(new TicketSentUser($chat_id, $userid, $ticketChat)); 
                \Mail::to($email)->queue(new TicketSentUser($chat_id, $userid, $ticketChat));


                $data['msg'] = 'success';
            } else {
                $data['msg'] = 'fail';
            }
        } else {
            $data['msg'] = 'required';
        }


        return json_encode($data);
    }

    public function userajaxchat(Request $request)
    {

        $uid = \Auth::id();
        $id     = $request->chat_id;

        $chatlist = TicketChat::where('ticketid', $id)->orderBy('id', 'ASC')->get();
        $userid = $chatlist[0]->uid;
        $userlist = User::where('id', $userid)->first();

        return view('ajax/adminchat', [
            'chatlist' => $chatlist,
            'username' => $userlist->name,
            'userlist' => $userlist
        ]);
    }

    public function newMsg(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ticket_id' => 'required| regex:/(^[A-Za-z0-9 ]+$)+/',
            'message' => 'required| regex:/(^[A-Za-z0-9 ]+$)+/',
            'user_id' => 'required',
        ]);


        if ($validator->fails()) {
            // toastr()->error($validator->errors()->first());
            return response()->json(["status" => false, 'result' => NULL, 'message' => $validator->errors()->first()], 200);
        }


        $chat_msg = new TicketChat();
        $chat_msg->uid = $request->user_id;
        $chat_msg->ticketid = $request->ticket_id;
        $chat_msg->message = NULL;
        $chat_msg->reply = $request->message;
        $chat_msg->user_status = 0;
        $chat_msg->admin_status = 1;
        $chat_msg->save();

        return response()->json(["status" => true, 'result' => $chat_msg, 'message' => '']);
    }
}
