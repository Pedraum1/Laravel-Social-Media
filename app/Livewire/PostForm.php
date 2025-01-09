<?php

namespace App\Livewire;

use App\Classes\EncryptionClass;
use App\Models\Post;
use Livewire\Component;

class PostForm extends Component
{
    public $textInput;
    public $hidden = False;

    public function showPostModal()
    {
        $this->hidden = !$this->hidden;
    }

    public function newPost()
    {
        $this->validate([
            'textInput'=>'required|max:150'
        ],[
            'textInput.required'=>'Você precisa escrever algo para escrever um post',
            'textInput.max'=>'O Tamanho máximo de um post é 150 caracteres'
        ]);
        $id = Post::createPost($this->textInput);
        return redirect()->route('seePost',EncryptionClass::encryptId($id));
    }
    public function render()
    {
        return view('livewire.post-form');
    }
}
