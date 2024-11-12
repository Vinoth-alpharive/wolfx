@php
    $atitle = 'support';
@endphp
@extends('layouts.header')
@section('title', 'Tickets - Reply')
@section('content')

    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Message</h1>
                <div class="top-btn"><a href="{{ url('/admin/support') }}"><i class="zmdi zmdi-arrow-left zmdi-hc-fw"
                            aria-hidden="true"></i> Back</a></div>
            </header>



            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('failed'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif



            <div class="alert alert-danger" style="display:none;" id="require_msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>Failed! </strong>Must fill all the fields!
            </div>


            <div class="alert alert-danger" style="display:none;" id="fail_msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>Failed! </strong>Try again!
            </div>



        </div>

        <div id="fail_msg">

        </div>

        <div class="messages">
            <div class="messages__body">
                <div class="messages__header">
                    <div class="toolbar toolbar--inner mb-0">
                        <div class="toolbar__label">Send by : {{ $username }}</div>
                    </div>
                </div>

                <div class="messages__content" id="chat-box">
                    @if ($chatlist)
                        @foreach ($chatlist as $row)
                            @if ($row->message != '')
                                <div class="messages__item">
                                    <div class="messages__details">
                                        @if ($userlist->profileimg)
                                            {{-- <img
                                                src="{{ Config::get('app.url') . '/public/storage/userprofile/' . $userlist->profileimg }}"></img> --}}
                                                 <img src="{{ url('images/client-2.png') }}"></img>
                                        @else
                                            <img src="{{ url('images/client-2.png') }}"></img>
                                        @endif
                                        <p>{{ $row->message }}</p>
                                        <small><i class="zmdi zmdi-time"></i>{{ $row->created_at }}</small>
                                        <div class="support-img-admin">
                                            @if(isset($row->image) && $row->image )
                                                <img src="{{ 'https://peopletrade.trade/storage/support/'.'/'.$row->image }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif



                            @if ($row->reply != '')
                                <div class="messages__item messages__item--right">
                                    <div class="messages__details">
                                        <img src="{{ url('images/adminchat.jpg') }}"></img>
                                        <p>{{ $row->reply }}</p>
                                        <small><i class="zmdi zmdi-time"></i> {{ $row->created_at }}</small>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif


                </div>

                <div class="messages__reply">

                    <div>

                        <input type="hidden" name="chat_id" id="chat_id" value="{{ $chatlist[0]->ticketid }}">
                        <input type="hidden" name="userid" id="userid" value="{{ $chatlist[0]->uid }}">


                        <div class="row">
                            <div class="col-lg-11 col-md-10 col-xs-12">
                                <textarea class="messages__reply__text message1" name="message" id="message" placeholder="Type a message..." required></textarea>
                            </div>
                            <div class="col-lg-1 col-md-2 col-xs-12">
                                <div class="adminchat-boxt">

                                    <button id="send-btn" type="button" name="add" class="btn btn-success">
                                        Send </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
        </div>
    </section>



@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var conn = new WebSocket(`wss://koinpair.ai:8090/?admin=true`);
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        var ticketId = "{{ $ticket_id }}";
        var message = $('#message');
        var user_id = "{{ $chatlist[0]->uid }}";
        var chatBox = $('#chat-box');

        conn.onopen = function(e) {
            console.log("Connection established!");

        };

        conn.onmessage = function(e) {
            var data = JSON.parse(e.data);

            if (data.response_new_message) {
				if(ticketId == data.ticket_id){
					appendReplyHtml(chatBox,data)
				}
            }

        }

        $("#send-btn").click(function() {
            let data = {
                '_token': csrfToken,
                'ticket_id': ticketId,
                'message': message.val(),
                'user_id': user_id,
				'admin':true
            };

            $('#send-btn').hide();
            setInterval(function() {
                $('#send-btn').show();
            }, 1500);

            if (message.val() == "") {
                $('#errormsg').show();
                return false;
            }

            fetch("{{ route('sendmsg') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status) {
                        let datas = {
                            type: 'request_new_message',
                            ticket_id: ticketId,
                            admin: true,
                            message: message.val(),
                            date: data.result.created_at
                        };
                        message.val('')
                        conn.send(JSON.stringify(datas));
                        appendMessageHtml(chatBox, data.result);
                    }
                })
                .catch(error => {
                    console.log('Error: ' + JSON.stringify(error));
                });

        });


        function appendMessageHtml(chatBox, data) {

            chatBox.append(`<div class="messages__item messages__item--right">
                                    <div class="messages__details">
                                        <img src="{{ url('images/adminchat.jpg') }}"></img>
                                        <p>${data.reply}</p>
                                        <small><i class="zmdi zmdi-time"></i>${data.created_at}</small>
                                    </div>
                                </div>`)
        }


        function appendReplyHtml(chatBox, data) {
            chatBox.append(`<div class="messages__item">
                                    <div class="messages__details">
                                        @if ($userlist->profileimg)
                                            <img
                                                src="{{ Config::get('app.url') . '/public/storage/userprofile/' . $userlist->profileimg }}"></img>
                                        @else
                                            <img src="{{ url('images/client-2.png') }}"></img>
                                        @endif
                                        <p>${data.message}</p>
                                        <small><i class="zmdi zmdi-time"></i>${data.date}</small>
                                    </div>
                                </div>`)
        }
    })
</script>
