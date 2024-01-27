<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    public function index(Request $request){
        $users = DB::table('users')
                ->when($request->input('name'), function($query, $name){
                    return $query->where('name', 'like', '%'.$name.'%');

                })
                
                ->select('id', 'name', 'email', 'phone', DB::raw('DATE_FORMAT(created_at,"%d, %M, %Y") as created_at'))
                ->where('roles', '=', 'dosen')
                ->paginate(10)
                ;



        return view('pages.lecturers.index', ['type_menu' => 'dashboard'], compact('users'));
    }
}
