<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\BlogPost;

class BlogPostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->user() && $request->user()->id) {
            return view('posts.create');
        } else {
            return redirect('/')->withErrors('Insufficient permissions to perform this operation');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new BlogPost();
        $title = $request->input('title');
        $post->title = $title;
        $post->content = $request->input('content');
        if(strlen($title) < 100 && strlen($post->content) < 1000 && strlen($post->content) > 1) {
            $user = $request->user();
            $user->posts()->save($post);
            $message = 'Post created successfully';
            $data['redirect'] = '/';
            return response()->json($data, 200);
        } else {
            $data['error'] = array();
            if(strlen($title) > 100) {
                $data['errors'][] = 'The title must be between 1 and 100 characters';
            }
            
            if(strlen($post->content) < 1 || strlen($post->content) > 1000) {
                $data['errors'][] = 'The content must be between 2 and 1000 characters';
            }
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = BlogPost::with('user')->where('id', $id)->first();
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $post = BlogPost::find($id);
        if($post && ($request->user() && $request->user()->id == $post->user->id)) {
            return view('posts.edit')->withPost($post);
        } else {
            return redirect('/')->withErrors('You do not have sufficient permissions to view this page');
        }
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
        $post_id = $request->input('post_id');
        $post = BlogPost::find($post_id);
        if($post && ($request->user() && $post->user->id == $request->user()->id))
        {
            $title = $request->input('title');
            $post->title = $title;
            $post->content = $request->input('content');
            
            $message = 'Post updated successfully';
            $post->save();
            $data['success'] = $message;
            return response()->json($data, 200);
        }
        else
        {
            $data['redirect'] = '/';
            return response()->json($data, 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = BlogPost::find($id);
        if($post && ($post->user->id == $request->user()->id)) {
            $post->delete();
            $data['success'] = 'Post deleted Successfully';
            $data['redirect'] = '/';
        } else {
            $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
            return response()->json($data, 401);
        }
        return response()->json($data, 200);
    }
}
