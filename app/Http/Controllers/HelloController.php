<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        return 'hello !';
    }

    public function view()
    {
        $data = [
            'msg' => 'hello there !',
        ];

        return view('hello.view', $data);
    }

    public function list()
    {
        $data = [
            'records' => Book::all(),
        ];

        return view('hello.list', $data);
    }
}
