<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加
use RegistersUsers;

class UsersController extends Controller
{

    
    public function index()
    {
        $users = User::paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        

        return view('users.show', [
            'user' => $user,
        ]);
    }
    
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function create()
    {
        $user = new User;

        return view('users.create', [
            'user' => $user,
        ]);
    }
    
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/admin/home');
    }
    
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', [
            'user' => $user,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/admin/home');
    }
    
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/admin/home');
    }
}
