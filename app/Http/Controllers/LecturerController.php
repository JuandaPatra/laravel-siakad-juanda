<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function create() {
        return view('pages.lecturers.create', [
            'type_menu' => 'dashboard'
        ]);
        
    }

    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'name'                      =>  'required|string|max:100',
                'phone'                     =>  'required|string',
                'email'                     =>  'required',
                'password'                  =>  'required',
                'roles'                     =>  'required',
                'address'                   =>  'required',

            ]
        );


        if ($validator->fails()) {

            // return $validator->fails();
            // return redirect()->back()->withInput($request->all())->withErrors($validator);

            return redirect()->back()->with('failed', 'failed X')->withInput($request->all());
        }
        // proses insert

        DB::beginTransaction();
        try {
            $post = User::create([
                'name'              =>  $request->name,
                'phone'             =>  $request->phone,
                'email'             =>  $request->email,
                'password'          =>  bcrypt($request->password),
                'roles'             => $request->roles,
                'address'           => $request->address
            ]);
           
            return redirect()->route('lecturer.index')->with('success', 'User Added');
        } catch (\throwable $th) {
            DB::rollBack();
            // Alert::error('Tambah Product', 'error' . $th->getMessage());
            // return redirect()->back()->withInput($request->all());
            return redirect()->back()->with('failed', 'Failed')->withInput($request->all());

        } finally {
            DB::commit();
        }
    }

   
}
