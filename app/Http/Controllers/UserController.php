<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $users = DB::table('users')
                ->when($request->input('name'), function($query, $name){
                    return $query->where('name', 'like', '%'.$name.'%');

                })
                
                ->select('id', 'name', 'email', 'phone', DB::raw('DATE_FORMAT(created_at,"%d, %M, %Y") as created_at'))
                ->where('roles', '=', 'mahasiswa')
                ->paginate(10)
                ;



        return view('pages.users.index', ['type_menu' => 'dashboard'], compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create',['type_menu' => 'dashboard'], );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
           
            return redirect()->route('user.index')->with('success', 'User Added');
        } catch (\throwable $th) {
            DB::rollBack();
            // Alert::error('Tambah Product', 'error' . $th->getMessage());
            // return redirect()->back()->withInput($request->all());
            return redirect()->back()->with('failed', 'Failed')->withInput($request->all());

        } finally {
            DB::commit();
        }
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
    public function edit(int $id)
    {
        $user = User::where('id', '=', $id)->first();

        // return $user;

        return view('pages.users.edit', ['type_menu' => 'dashboard'], compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'                      =>  'required|string|max:100',
                'phone'                     =>  'required|string',
                'email'                     =>  'required',
                // 'password'                  =>  'required',
                'roles'                     =>  'required',
                'address'                   =>  'required',

            ]
        );


        if ($validator->fails()) {

            // return $validator->fails();
            // return redirect()->back()->withInput($request->all())->withErrors($validator);

            return redirect()->back()->with('failed', $validator->fails())->withInput($request->all());
        }
        // proses insert

        DB::beginTransaction();
        try {

            $post = User::where('id','=', $id);

            $post->update([
                'name'              =>  $request->name,
                'phone'             =>  $request->phone,
                'email'             =>  $request->email,
                // 'password'          =>  bcrypt($request->password),
                'roles'             => $request->roles,
                'address'           => $request->address

            ]);
           
            return redirect()->route('user.index')->with('success', 'Update User');
        } catch (\throwable $th) {
            DB::rollBack();
            // Alert::error('Tambah Product', 'error' . $th->getMessage());
            // return redirect()->back()->withInput($request->all());
            return redirect()->back()->with('failed', 'Failed Update User')->withInput($request->all());

        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::where('id','=', $id );

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Delete User');
    }
}
