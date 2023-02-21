<?php

namespace App\Http\Controllers\Executive;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
        ->join('genders', 'users.gender_id', '=', 'genders.id')
        ->where('users.id', '=', Auth::id())
        ->select('users.*','genders.gender_name', 'districts.district_name')
        ->get();

        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('executive.myprofile', compact('users', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $newPost = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id()
        ]);
        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
        ->join('genders', 'users.gender_id', '=', 'genders.id')
        ->where('users.id', '=', Auth::id())
        ->select('users.*','genders.gender_name', 'districts.district_name')
        ->get();

        $posts = Post::orderBy('created_at', 'desc')
        ->where('posts.user_id', '=', Auth::id())
        ->get();
        return view('executive.myposts', compact('posts', 'users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewpost($post_id)
    {
        $post = Post::join('users', 'posts.user_id', 'users.id')
        ->where('posts.id', '=', $post_id)
        ->select('users.name', 'posts.*')
        ->get();
        return view('executive.view-post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($blogpost)
    {
        $post = Post::where('id', '=', $blogpost)->get();
        return view('executive.editpost', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $blogPost)
    {
        Post::where('id', '=', $blogPost)->update([
            'title' => $request->title,
            'body' => $request->body
        ]);
        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
            ->join('genders', 'users.gender_id', '=', 'genders.id')
            ->where('users.id', '=', Auth::id())
            ->select('users.*','genders.gender_name', 'districts.district_name')
            ->get();

        $posts = Post::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('executive.myposts', compact('users', 'posts'));
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', '=', $id)->delete();
        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
            ->join('genders', 'users.gender_id', '=', 'genders.id')
            ->where('users.id', '=', Auth::id())
            ->select('users.*','genders.gender_name', 'districts.district_name')
            ->get();

        $posts = Post::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get();
        Toastr::success('Post Deleted Successfully', 'success');

        return view('executive.myposts', compact('users', 'posts'));
    }
    
    public function show()
    {
        $users = User::join('districts', 'users.district_id', '=', 'districts.id')
        ->join('genders', 'users.gender_id', '=', 'genders.id')
        ->where('users.id', '=', Auth::id())
        ->select('users.*','genders.gender_name', 'districts.district_name')
        ->get();

        $posts = Post::orderBy('created_at', 'desc')
        ->where('posts.user_id', '=', Auth::id())
        ->get();
        return view('executive.myposts', compact('posts', 'users'));
    }
}
