<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
Use Storage;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all()->toArray();
        return array_reverse($posts);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|image|max:2048',
        ]);



        $post =new Post();
        $post->name= $request->name;
        $post->description=$request->description;
        if ($request->file('file')) {
            $imageName=$request->file->store('portadas','public');
        } else{
            $imageName="";
        }
        $post->image=$imageName;
        $post->save();



        return response()->json(['success'=> 'Post created successfully']);

    }

    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function update($id, Request $request)
    {
        $post = Post::find($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        if ($request->file('file')) {
            // eliminar archivo existente
            Storage::disk('public')->delete($post->image);
            $imageName=$request->file->store('portadas','public');
            $post->image=$imageName;

            $post->update([
                'name'=> $request->name,
                'description'=> $request->description,
                'image'=> $imageName,
            ]);
        } else{
            $post->update([
                'name'=> $request->name,
                'description'=> $request->description,
            ]);
        }


        return response()->json(['success'=> 'Post update successfully']);
    }

    public function delete($id)
    {
        $post = Post::find($id);

        // eliminar archivo existente
         Storage::disk('public')->delete($post->image);
        //eliminar
        // unlink('img/'.$post->image);
        $post->delete();
        return response()->json(['success'=> 'Post deleted successfully']);

    }
}
