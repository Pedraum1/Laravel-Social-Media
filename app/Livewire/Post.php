<?php

namespace App\Livewire;

use App\Classes\Encryption;
use Livewire\Component;
use App\Models\Post as PostModel;
use Carbon\Carbon;

class Post extends Component
{
    public $id, $post;

    public function mount($post_id)
    {
        $this->post = PostModel::find($post_id);
        $this->id = Encryption::encrypt($post_id);
        $this->post->date = Carbon::parse($this->post->created_at)->diffForHumans();
    }

    public function render()
    {
        return view('livewire.post');
    }
}
