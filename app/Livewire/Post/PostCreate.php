<?php

namespace App\Livewire\Post;

use App\Livewire\Forms\PostForm;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

class PostCreate extends Component
{
    use WithFileUploads;
    #[Title("Create Post")]

    public PostForm $form;

    public function save(){
        $this->validate();
        if ($this->form->picture) {
            $picturePath = $this->form->picture->store('pictures', 'public');
        }else{
            $picturePath = null;
        }

        $post = auth()->user()->posts()->create([
            "body"=> $this->form->body,
            "picture" => $picturePath,
        ]);
        // dd($post);

        session()->flash("success","Post has uploaded successfully");
        return redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.post.post-create');
    }
}
