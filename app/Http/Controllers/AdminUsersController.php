<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Role;
use App\User;
use App\Photo;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users=User::all();


        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::pluck('name','id')->all();

        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

       // User::create($request->all());

       // return redirect('admin/users');

        $input  = $request->all();    //to ge the Input from the Web
        if ( $file = $request->file('photo_id') ){   // check if the Photo Exists
            $name  =  time(). $file->getClientOriginalName();  // get the name  you prbaly will rename it

            $file->move('images',$name); // Move the File to A directory

            $photo = photo::create(['file'=>$name]);

            $input['photo_id']=$photo->id;

        }

        $input['password'] = bcrypt($request->password); // to decrypt the PAssword

        User::create($input);

      //  return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //  return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
