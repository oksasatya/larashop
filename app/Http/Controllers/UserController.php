<?php

namespace App\Http\Controllers;

use view;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request,$next){
            if(Gate::allows('manage-users')) return $next($request);

            abort(403,'Anda Tidak Memiliki cukup hak akses');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate('10');
        $filterKeyword = $request->get('keyword');
        $status = $request->get('status');

        if ($filterKeyword) {
            if ($status) {
                $users = User::where('email', 'LIKE', "%$filterKeyword%")
                    ->where('status', $status)
                    ->paginate(10);
            } else {
                $users = User::where('email', 'LIKE', "%$filterKeyword")->paginate(10);
            }
        }
        if ($status) {
            $users = User::where('status', $status)->paginate(10);
        } else {
            $users = User::paginate(10);
        }

        $data = [
            'users' => $users,
            'status' => $status,
        ];

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {


        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'roles' => json_encode($request->roles),
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if (request('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');

            $user->avatar = $file;
        }


        return redirect()->route('users.create')->with('status', 'User Succesfully Create');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorFail($id);

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $updateUserRequest,$id)
    {
        $request = new Request();
        $user = User::findorfail($id);
        $user->name = $updateUserRequest->name;
        $user->roles = json_encode($updateUserRequest->roles);
        $user->address = $updateUserRequest->address;
        $user->phone = $updateUserRequest->phone;
        $user->status = $updateUserRequest->status;


        if($request->file('avatar')){
            if($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))){
                Storage::delete('public/'.$user->avatar);
            }
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }
        // dd($user->avatar);

        $user->save($request->all());
        return redirect()->route('users.edit', [$id])->with('status', 'User Succesfully updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User Succesfully Delete');
    }
}
