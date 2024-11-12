<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = GeneralSetting::where('key', 'reward')->paginate(15);
        return view('reward.list', compact('rewards'));
    }

    public function newoffer()
    {
        return view('reward.newoffer');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:250',
            'description' => 'required|max:250',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        // dd($request->all());

        $reward = new GeneralSetting();
        $reward->title = $request->title;
        $reward->key = 'reward';
        $reward->description = $request->description;


        if (isset($request->image)) {
            $pho = $request->image;

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randstring = '';
            for ($i = 0; $i < 20; $i++) {
                $randstring .= $characters[rand(0, strlen($characters))];
            }

            $photnam = $randstring;
            $filename = pathinfo($photnam, PATHINFO_FILENAME);
            $extension = $pho->getClientOriginalExtension();
            $photo = $filename . '.' . $extension;
            Storage::disk('ftpcoin')->put($photo, fopen($request->file('image'), 'r+'));
        } else {
            return back()->with('error', 'Reward Image Mandatory! please upload');
        }

        $reward->image = $photo;
        $reward->save();

        return back()->with('status', 'Reward addess successfully');
    }

    public function viewoffer($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (Exception $e) {
            return back()->with('error', 'Invalid reward id');
        }

        $reward = GeneralSetting::find($id);
        if ($reward) {
            return view('reward.viewoffer', compact('reward'));
        } else {
            return back()->with('error', 'Invalid reward id');
        }
    }

    public function updateoffer(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:250',
            'description' => 'required|max:250',
            'image' => 'image|mimes:jpeg,png,jpg|max:500',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        try {
            $id = Crypt::decrypt($id);
        } catch (Exception $e) {
            return back()->with('error', 'Invalid reward id');
        }

        $reward = GeneralSetting::find($id);
        if (!$reward) {
            return back()->with('error', 'Invalid reward id');
        }

        try {
            if (isset($request->image)) {
                $pho = $request->image;

                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randstring = '';
                for ($i = 0; $i < 20; $i++) {
                    $randstring .= $characters[rand(0, strlen($characters))];
                }

                $photnam = $randstring;
                $filename = pathinfo($photnam, PATHINFO_FILENAME);
                $extension = $pho->getClientOriginalExtension();
                $photo = $filename . '.' . $extension;

                if ($reward->image != "") {
                    Storage::disk('ftpcoin')->delete($reward->image);
                }

                Storage::disk('ftpcoin')->put($photo, fopen($request->file('image'), 'r+'));
                $reward->image = $photo;

            } else {
                $reward->image = $reward->image;
            }
        } catch (Exception $e) {
            $reward->image = $reward->image;
        }

        $reward->title = $request->title;
        $reward->description = $request->description;
        $reward->save();

        return back()->with('status', 'Reward updated successfully');
    }

    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (Exception $e) {
            return back()->with('error', 'Invalid reward id');
        }

        $reward = GeneralSetting::find($id);
        if (!$reward) {
            return back()->with('error', 'Invalid reward id');
        }

        $reward->delete();

        return back()->with('error','Reward Deleted Successfully');
    }
}
