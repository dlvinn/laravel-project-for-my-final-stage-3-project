<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // view create form
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate incoming request data with validation rules
        $this->validate(request(), [
            'title' => 'required|min:1|max:255',
            'body'  => 'required|min:1|max:300'
        ]);

        // store data with create() method
        $post = Post::create([
            'user_id'   => auth()->id(),
            'title'     => request()->title,
            'body'      => request()->body
        ]);

        // redirect to show post URL
        return redirect($post->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // we are using route model binding
        // view show page with post data
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // we are using route model binding
        // view edit page with post data
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // validate incoming request data with validation rules
        $this->validate(request(), [
            'title' => 'required|min:1|max:255',
            'body'  => 'required|min:1|max:300'
        ]);

        // update post with new data using update() method
        $post->update([
            'title'     => request()->title,
            'body'      => request()->body
        ]);

        // return to show post URL
        return redirect($post->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $myPost = Post::find($id);
        $myPost->delete();
        // return to show post URL
        return redirect('admin/dashboard');


    }


    public function destroyForUser($id)
    {

        $myPost = Post::find($id);
        $myPost->delete();
        // return to show post URL
        return redirect('/dashboard');


    }
}
