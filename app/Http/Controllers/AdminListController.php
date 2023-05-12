<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;

class AdminListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

        return view('backend.authorization.adminList.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('backend.authorization.adminList.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(UserRequest $request)
    {
        // first way to create user...

        // $userValid = $request->validated();

        // $userValid['password'] = Hash::make($userValid['password']);

        // $user = User::create($userValid);

        // $user->assignRole($userValid['roles']);

        // return redirect()->route('adminList.index');

        // second way to create user...

        $data = $request->validated();

        try {
            DB::transaction(function() use($data){
                $result = array_merge($data,['type'=>'dashboard',
                        'password'=>Hash::make('12345678'),'is_block'=>1]
                );

                $user = User::create($result);
                $user->assignRole($data['roles']);
                return $user;
            });


        } catch (Exception $e) {
            Log::channel('web_daily_error')->error("Admin Create",[$e->getMessage()]);
            //throw new Exception($e->getMessage(),500);
            return Redirect::back()->withErrors($e->getMessage());
        }

        return redirect()->route('adminList.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('backend.authorization.adminList.view',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,$id)
    {

        $users = User::where('id',$id)->first();

        $roles = Role::all();

        return view('backend.authorization.adminList.edit',compact('users','roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataValid = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required'
        ]);

        $user = User::find($id);

        $user->update($dataValid);

        $user->syncRoles($dataValid['roles']);

        return redirect()->route('adminList.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        User::find($id)->delete();

        return redirect()->route('adminList.index');
    }
}