<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostCreateRequest;
use App\photo;
use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// I have created this Controller by php artisan make:controller --resource AdminPostsController
// a route has been created before

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::all();


        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $category = Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        //note here we are using PostCreateRequest to Validate the form entries as we created this Request

        $input =  $request ->all(); // assign the Request to a variable

        $user = Auth::user();  // to get the logged in user

        if($file =$request->file('photo_id')){  // to check if the file is uploaded

            $name = time().$file->getClientOriginalName();  // here you can Rename as you wish

            $file->move('images',$name); // move the File to the Desired destination
            // ypu may wanna Consider Different Locations for Diffrent types such as userpics/posts ,, etc and Also to make sure its
            // a file not a different file , and resize it into desired size
            // and Delete the Previous one if exists.

            $photo = Photo::create(['file'=>$name]);  // to Create the Photo

            $input['photo_id']=$photo->id; // Update the Input Data of photo Id to be taken from the one we created in Photo table

        }

      //  $input['category_id']=0;  // for now as we  dont have default vaoue for it in the DB
        $user->posts()->create($input);  // i guess this one to store user ID

        return redirect('/admin/posts');


       // return $request->all();  // if you want to print the values
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
