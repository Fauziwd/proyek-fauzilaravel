<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get Posts
        $posts = Post::oldest()->paginate(5);

        //render view with posts
        return view('posts.index', compact('posts'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'number'     => 'required|min:1',
            'name'   => 'required|min:4',
            'email'     => 'required|min:5',
            'phone'   => 'required|min:10',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        //create post
        Post::create([
            
            'number'     => $request->number,
            'name'   => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'image'     => $image->hashName()
        ]);

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * edit
     *
     * @param  mixed $post
     * @return void
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Post $post)
    {
        //validate form
        $request->validate([
            'number'     => 'required|min:1',
            'name'   => 'required|min:4',
            'email'     => 'required|min:5',
            'phone'   => 'required|min:10',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/'.$post->image);

            //update post with new image
            $post->update([
                'number'     => $request->number,
                'name'   => $request->name,
                'email'   => $request->email,
                'phone'   => $request->phone,
                'image'     => $image->hashName()
            ]);

        } else {

            //update post without image
            $post->update([
                'number'     => $request->number,
            'name'   => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone
            ]);
        }

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Post $post)
    {
        //delete image
        Storage::delete('public/post/'. $post->image);

        //delete post
        $post->delete();

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}