<?php

namespace App\Http\Controllers;

use App\Models\pic;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Backtrace\File;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Models\Role;

class mediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = pic::with('author')->get();
        $users = User::latest()->get();
        return view('post', compact('posts','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('addImage');
    }

    public function store(Request $request, $id)
    {
        // dd($request);
        $this -> validate($request, [
            'name' => 'required',
            'Title' => 'required',
            'desc' => 'required'

        ]);

        $input = $request->all();

        $users = pic::create([
            'Author' => $request->input('name'),
            'Title' => $request->input('Title'),
            'Description' => $request->input('desc'),
        ]);

        if($request->hasFile('img') && $request->file('img')->isValid()){
            $users->addMediaFromRequest('img')->toMediaCollection();
        }

        $users -> save($input);
        return redirect()->route('post');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = pic::find($id);

        return view('editImage',compact('posts'));
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
        $this -> validate($request, [
            'name' => 'required',
            'Title' => 'required',
            'desc' => 'required'

        ]);

        $input = $request->all();

        $posts = pic::find($id);
        $posts -> Author = $request -> name;
        $posts -> Title = $request -> Title;
        $posts -> Description = $request -> desc;
        if($request->hasFile('img') && $request->file('img')->isValid()){
            $posts->clearMediaCollection();
            $posts->addMediaFromRequest('img')->toMediaCollection();
        }

        $posts -> save();
        return redirect()->route('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img = pic::find($id);
        $img -> delete();
        $img -> clearMediaCollection();

        return redirect()->route('post');
    }
}
