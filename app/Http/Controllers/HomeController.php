<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
use App\Http\Requests;
use App\Book;
use App\Author;
use App\Role;
use App\BorrowLog;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Laratrust::hasRole('member')) {

            $borrowLogs = Auth::user()->borrowLogs()->borrowed()->get();

            return view('dashboard.member', compact('borrowLogs'));
        }
		else if (Laratrust::hasRole('walikelas')) {
            return view('dashboard.guru');
        }
        else if (Laratrust::hasRole('admin')) {

            $author = Author::all();

            $book = Book::all();

            $member = Role::where('name', 'member')->first()->users;

            $borrow = BorrowLog::all();

            return view('dashboard.admin', compact('author', 'book', 'member', 'borrow'));
        }

        return view('login');
    }
}
