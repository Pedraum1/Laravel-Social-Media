<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function images(): HasMany {
        return $this->hasMany(Image::class,'source_id','id')->where('type','post');
    }

    public static function createPost($text){
        $post = new Post();
        $user = User::getUserByTag(session('user.tag'));

        $post->user_id = $user->id;
        $post->type = 'post';
        $post->text = $text;
        $post->save();

        $user->postsNumber += 1;
        $user->save();

        return $post->id;
    }

    public static function createReply($text,$post_id){
        $reply = new Post();
        $user = User::getUserByTag(session('user.tag'));

        $reply->user_id = $user->id;
        $reply->source_id = $post_id;
        $reply->type = 'reply';
        $reply->text = $text;

        $reply->save();

        $post = Post::find($post_id);
        $post->comments += 1;
        $post->save();
    }

    public function getComments(): HasMany{
        return $this->hasMany($this,'source_id','id')->where('deleted_at',null);
    }

    public function originalPost(): BelongsTo {
        return $this->belongsTo($this,'source_id','id')->where('deleted_at',null);
    }

}
