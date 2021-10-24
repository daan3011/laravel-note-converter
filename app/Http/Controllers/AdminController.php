<?php

namespace App\Http\Controllers;

use App\Models\LimitCheck;
use App\Models\User;
use App\Models\Note;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use PhpParser\Node\Expr\FuncCall;

class AdminController extends Controller
{
    public $apiData = '';
    public function __construct() {
        $this->apiData = LimitCheck::get()->first();
    }
    // overal apiData passen naar view en uitlezen in admin.blade.php met een progress bar



    public function index() {
        if (auth()->user()->role != 'admin') {
            return view('convert');
        }
        return view('admin')->with(['admins' => User::where('role', '=', 'admin')->paginate(5, ['*'], 'admins'), 'users' => User::where('role', '!=', 'admin')->paginate(7, ['*'], 'users'), 'latestNotes' => Note::take(5)->get(), 'apiData' => $this->apiData]);
    }

    public function search(Request $request)
    {
        //ins admin view checken of variable search ofzo get is, anders de hele tabel printen. bij search de hele tabel vervangen door de results
        $search =  $request->input('results');
        if($search!=""){
            $users = User::where(function ($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            })
            ->paginate(5);
            $users->appends(['results' => $search]);
        }
        else{
            $users = User::paginate(5);
        }

        //dd($users);
        return View('admin')->with(['admins' => User::where('role', '=', 'admin')->paginate(5, ['*'], 'admins'),'users' => $users, 'latestNotes' => Note::take(5)->get(),'apiData' => $this->apiData]);
        //
    }


    public function makeAdmin($id) {
        if (auth()->user()->role != 'admin') {
            return view('convert');
        }
        $user = User::where('id', '=', $id)->first();
        $user->role = 'admin';
        $user->save();
        return view('admin')->with(['admins' => User::where('role', '=', 'admin')->paginate(5, ['*'], 'admins'), 'users' => User::where('role', '!=', 'admin')->paginate(7, ['*'], 'users'), 'latestNotes' => Note::take(5)->get(), 'apiData' => $this->apiData]);
    }

    public function makeUser($id) {
        if (auth()->user()->role != 'admin') {
            return view('convert');
        }
        $user = User::where('id', '=', $id)->first();
        $user->role = 'user';
        $user->save();
        return view('admin')->with(['admins' => User::where('role', '=', 'admin')->paginate(5, ['*'], 'admins'), 'users' => User::where('role', '!=', 'admin')->paginate(7, ['*'], 'users'), 'latestNotes' => Note::take(5)->get(), 'apiData' => $this->apiData]);
    }

    public function userNotes($id) {
        if (auth()->user()->role != 'admin') {
            return view('convert');
        }
        $notes = Note::where('user_id', $id)->get();
        return view('adminNotes')->with(['notes' => $notes]);
    }

    public function deleteUserNote($id) {
        if (auth()->user()->role != 'admin') {
            return view('convert');
        }
        Note::destroy($id);
        $notes = Note::where('user_id', $id)->get();
        return view('adminNotes')->with(['notes' => $notes]);
    }

    public function deleteUser($id) {
        if (auth()->user()->role != 'admin') {
            return view('convert');
        }
        User::destroy($id);
        return view('admin')->with(['admins' => User::where('role', '=', 'admin')->paginate(5, ['*'], 'admins'), 'users' => User::where('role', '!=', 'admin')->paginate(7, ['*'], 'users'), 'latestNotes' => Note::take(5)->get(), 'apiData' => $this->apiData]);
    }
}
