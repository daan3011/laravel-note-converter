<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function index() {
        $notes = Note::whereHas('user', function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        })->orderBy('created_at', 'desc')->get();
        return view('profile')->with(['notes' => $notes]);
    }

    public function viewNote($id) {
        $note = Note::where('id', $id)->first();
        if (Auth::check() && Auth::user()->id == $note->user_id) {
            return view('viewNote')->with(['note' => $note]);
        } else {
            return view('convert');
        }
    }

    public function editNote($id)
    {
        $note = Note::where('id', $id)->first();
        if (Auth::check() && Auth::user()->id == $note->user_id) {
            return view('editNote')->with(['note'=> $note]);
        } else { 
            return view('convert');
        }
    }

    public function editNotePost($id) {
        $note = Note::where('id', $id)->first();
        if (Auth::check() && Auth::user()->id == $note->user_id) {
            $note->update(['name' => strip_tags($_POST['noteTitle']), 'note' => strip_tags($_POST['noteBody']), 'share_link' => strip_tags($_POST['shareLink'])]);

            $notes = Note::whereHas('user', function ($query) {
                return $query->where('user_id', '=', Auth::user()->id);
            })->get();;
            return view('profile')->with(['notes'=> $notes]);
        } else {
            return view('convert');
        }
    }

    protected function deleteNote($id) {
        $note = Note::where('id', $id)->first();
        if (Auth::check() && Auth::user()->id == $note->user_id) {
            Note::destroy($id);
        }

        $notes = Note::whereHas('user', function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        })->get();;
        return redirect()->route('profile')->with(['notes' => $notes]);
    }

    public function sharedNote($sharelink) {
        $note = Note::where('share_link', $sharelink)->first();
        return view('sharedNote')->with(['note'=>$note]);
    }
}
