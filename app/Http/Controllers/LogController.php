<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin())
            $activitylog = Activity::orderBy('created_at','DESC')->paginate(30);
        else
            return view('auth/login');
           
        return view('log/index', compact('activitylog'));
    }
}
