<?php

namespace App\Http\Controllers;

use App\Models\pic;
use Illuminate\Http\Request;
use App\Models\User;
use Database\Seeders\userSeed;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('home', compact('users'));
    }

    public function edit($id)
    {
        $Edit = User::find($id);

        $roles = Role::all();
        //dd($roles);
        return view('edit', compact('Edit','roles'));
    }

    public function editRole($id)
    {
        $Edit = User::find($id);

        $roles = Role::all();
        //dd($roles);
        return view('assign', compact('Edit','roles'));
    }

    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $user = User::find($id);
        $user -> name = $request-> name;
        $user -> email = $request-> email;
        $user -> syncRoles($request-> input('role'));
        $res = $user->save();


        if($res){
            return redirect('home')->with('success_update', 'Successfully updated!');
        }else{
            return back()->with('fail', 'Something wrong, please try again.');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->roles()->detach();
        $res= $user->delete();
        if($res){
            return redirect('home')->with('success_delete', 'Successfully deleted!');
        }else{
            return back()->with('fail', 'Something wrong, please try again.');
        }
    }
}
