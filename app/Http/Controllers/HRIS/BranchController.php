<?php

namespace App\Http\Controllers\HRIS;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function fetch_branches() {
        $branches = DB::table('branches')->get();
        return view('auth.login', compact('branches'));
    }
}
