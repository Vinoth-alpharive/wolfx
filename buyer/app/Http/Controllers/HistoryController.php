<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\Coinwithdraw;
use Auth;

class HistoryController extends Controller
{
    public function withdraw()
    {
        $uid= Auth::id();
        $coinsList = Commission::get();
        $historys = Coinwithdraw::listView($uid);
        return view('history.withdraw',['coinsList' => $coinsList,'historys' => $historys]);
    }
}
