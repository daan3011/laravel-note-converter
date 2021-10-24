<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use AhmadMayahi\Vision\Vision;
use App\Models\LimitCheck;
use App\Models\Note;
use Illuminate\Cache\RateLimiting\Limit;

class ConvertController extends Controller
{
    public function index()
    {

        //if statement to check if user is admin and redirect to other route
        return view('convert');
    }

    public function convertPost(Request $request, Vision $vision)
    {
        $noteTitle = strip_tags($_POST['noteTitle']);
        $request->validate([
            'noteImg' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $limitCheckObj = new LimitCheck();
        $quota = LimitCheck::first();
        if (is_null($quota)) {
            // Table is empty.
            $limitCheckObj->quota = 0;
            $limitCheckObj->date_check = date('Y-m-d');
            $limitCheckObj->save();
            $quota = LimitCheck::first();
        }

        if ($quota->quota < 1000) {
            $vision = app(Vision::class);
            $result = $vision
                ->file($request->noteImg)
                ->imageTextDetection()
                ->getDocument();
            $result->getLocale(); // locale, for example "en" for English
            if (Auth::check()) {
                $note = new Note;
                $note->name = $noteTitle;
                $note->note = $result->getText();
                $note->share_link = Str::random(10);
                $note->user_id = Auth::user()->id;
                $note->save();
                $quota->quota = $quota->quota + 1;
                $quota->save();
                return view('converted')->with(['noteTitle' => $noteTitle, 'noteBody' => $result->getText(), 'shareLink' => $note->share_link]);
            } else {
                $quota->quota = $quota->quota + 1;
                $quota->save();
                return view('converted')->with(['noteTitle' => $noteTitle, 'noteBody' => $result->getText()]);
            }
        } else {
            // check for date difference 31 days
        $now = strtotime(date('Y-m-d'));
            $dateCheck = strtotime($quota->date_check);
            $dateDiff = $now - $dateCheck;
            if ($dateDiff >= 31) {
                // delete and reset date
                LimitCheck::destroy($quota->id);
                $limitCheckObj->quota = 0;
                $limitCheckObj->date_check = date('Y-m-d');
                $limitCheckObj->save();
            }
            return view('convert');
        }
    }
}
