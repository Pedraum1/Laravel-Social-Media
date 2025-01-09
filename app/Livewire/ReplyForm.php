<?php

namespace App\Livewire;

use App\Classes\EncryptionClass;
use App\Models\Post;
use Livewire\Component;

class ReplyForm extends Component
{
    public $hidden = False;
    public $original_post,$textInput;

    public function mount($post_id){
        $post_id = EncryptionClass::decryptId($post_id);
        $this->original_post = Post::find($post_id);
    }
    
    public function showReplyModal(){
        $this->hidden = !$this->hidden;
    }

    public function newReply(){
        $this->validate([
            'textInput'=>'required|max:150'
        ],[
            'textInput.required'=>'Você precisa escrever algo para escrever um post',
            'textInput.max'=>'O Tamanho máximo de um post é 150 caracteres'
        ]);
        Post::createReply($this->textInput, $this->original_post->id);
        $this->showReplyModal();
        return redirect()->route('seePost', EncryptionClass::encryptId($this->original_post->id));
    }

    public function render()
    {
        return view('livewire.reply-form');
    }
}
