<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{

    public function option(Request $request){
        $users = User::where('name','like','%'.$request->q.'%')->get();
    return response()->json($users, 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = DB::table('subjects')
                ->when($request->input('name'), function($query, $name){
                    return $query->where('name', 'like', '%'.$name.'%');

                })
                ->leftJoin('users','users.id', '=', 'subjects.lecturer_id')
                ->select('subjects.id', 'subjects.title','subjects.semester','subjects.academic_year','users.name AS lecturer' ,'subjects.code', 'subjects.sks', DB::raw('DATE_FORMAT(subjects.created_at,"%d, %M, %Y") as created_at',  ))
                ->paginate(10)
                ;

        // return $users;

        return view('pages.subjects.index', ['type_menu' => 'dashboard-lecturer'], compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.subjects.create', [
            'type_menu' => 'Dashboard',
            'type_detail' => 'Create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}
