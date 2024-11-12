<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WelcomeRewardController extends Controller
{
    public function index()
    {
        $welcome_rewards = GeneralSetting::where('key', 'welcomereward')->paginate(15);
        return view('welcomereward.list', compact('welcome_rewards'));
    }

    public function newreward()
    {
        return view('welcomereward.newreward');
    }

    public function create(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|max:250',
        //     'description' => 'required|max:250',
        //     // 'image' => 'required|image|mimes:jpeg,png,jpg|max:500',
        // ]);

        $request->validate([
            'title' => 'required|max:250',
            'description' => 'required|max:250',
        ]);

        $reward = new GeneralSetting();
        $reward->title = $request->title;
        $reward->key = 'welcomereward';
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

    public function viewreward($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (Exception $e) {
            return back()->with('error', 'Invalid reward id');
        }

        $reward = GeneralSetting::find($id);
        if ($reward) {
            return view('welcomereward.viewreward', compact('reward'));
        } else {
            return back()->with('error', 'Invalid reward id');
        }
    }

    public function updatereward(Request $request, $id)
    {
        // echo "<pre>";print_r($request->all());exit;
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|max:250',
        //     'description' => 'required|max:250',
        //     'image' => 'image|mimes:jpeg,png,jpg|max:500',
        // ]);

        // if ($validator->fails()) {
        //     return back()->with('error', $validator->errors());
        // }

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
                //$reward->image = $reward->image;
            }
        } catch (Exception $e) {
            // $reward->image = $reward->image;
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
