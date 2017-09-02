<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Role;
use App\User;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        return view('admin.users.create',compact('roles'));  // notice here we send the Roles to the Form the use it
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

        return redirect('admin/users');

      //  return $request->all();  // to check the Output from Subit
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
        $user = User::findOrFail($id);

        $roles = Role::pluck('name','id');

        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);

        if (trim($request->password )== ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password']=bcrypt($request->password);
        }

      //  $input = $request->all();

        if ($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);

            $photo =Photo::create(['file'=>$name]);

            $input['photo_id']=$photo->id;
        }

        $user->update($input);

        return redirect('/admin/users');

     //   return $request->all();
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

        $user = User::findOrFail($id);

        unlink(public_path().$user->photo->file);  // to Delete the User Image when Deleting

        $user->delete();

        Session::flash('deleted_user','The user has been Deleted');

       return redirect('/admin/users');

    }
}
