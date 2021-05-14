<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Post;
use App\Models\User;
class PostController extends Controller
{
    //
    public function index()
    {
        $posts = auth()->user()->posts()->paginate(5);
        return view('admin.posts.index', ['posts'=>$posts]);
    }
    public function show(Post $post)
    {
        return view('blog-post', ['post'=>$post]);
    }
    public function create()
    {
        return view('admin.posts.create');
    }
    public function store()
    {
        // dd(request()->all());
        $inputs = request()->validate([
            'title' => 'required|max:255',
            'post_image' => 'file',
            'body' => 'required|min:5|max:255'
        ]);
        if(request('post_image')){
            // $inputs['post_image'] = request('post_image')->store('images');
            $inputs['post_image'] = time() . '.' . request()->post_image->extension();
            request()->post_image->move(public_path('images'), $inputs['post_image']);
        }
        auth()->user()->posts()->create($inputs);
        session()->flash('message-created', $inputs['title'].' Post is Successfully Created');
        return redirect()->route('post.index');
    }

    public function edit(Post $post,Request $request)
    {
        // $this->authorize('view', $post);
        if(!auth()->user()->can('view',$post)){
            $request->session()->flash('message-edit', 'You are not authorized to Edit this post');
            return back();
        }
        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function destroy(Post $post, Request $request)
    {
        if(!auth()->user()->can('view',$post)){
            $request->session()->flash('message-edit', 'You are not authorized to Delete this post');
            return back();
        }
        $post->delete();
        $request->session()->flash('message', 'Selected Post is Succesfully Deleted');
        return back();
    }

    public function update(Post $post)
    {
        $inputs = request()->validate([
            'title' => 'required|max:255',
            'post_image' => 'file',
            'body' => 'required|min:5'
        ]);
        if(request('post_image')){
            // $inputs['post_image'] = request('post_image')->store('images');
            $inputs['post_image'] = time() . '.' . request()->post_image->extension();
            request()->post_image->move(public_path('images'), $inputs['post_image']);
            $post->post_image = $inputs['post_image'];
        }
        $post->title = $inputs['title'];   
        $post->body = $inputs['body'];

        $this->authorize('update',$post);
        $post->save();
        session()->flash('message-updated', 'Post Successfully Updated');
        return redirect()->route('post.index');
    }
}
