<?php

namespace App\Http\Controllers;

use App\Classes\Encryption;
use App\Models\Post;

class MainController extends Controller
{
    public function home(){

        $posts = Post::orderBy('created_at','DESC')->where('deleted_at',null)->where('type','post')->paginate(25);
        
        $post_array = [];
        foreach($posts as $post){
            $post->views += 1;
            $post->save();

            array_push($post_array,$post->id);
        }

        return view('home',['posts'=>$post_array]);
    }

    public function post($id){
        $id = Encryption::decrypt($id);
        $post = Post::find($id);
        if($post->getComments){
            return view('postPage',['post'=>$post,'comments'=>$post->getComments]);
        }
        return view('postPage',['post'=>$post]);
    }

    public function deletePost($id){
        $id = Encryption::decrypt($id);
        $post = Post::find($id);
        $post->delete();

        if($post->type == 'reply'){
            $original_post = $post->originalPost;
            $original_post->comments -= 1;
            $original_post->save();

            return redirect()->route('seePost',Encryption::encrypt($original_post->id));
        }

        $post->owner->postsNumber -= 1;
        $post->owner->save();

        return redirect()->route('home');
        
        #TODO: TRANSFERIR ESSA FUNÇÃO PARA O LIVEWIRE
    }
}
