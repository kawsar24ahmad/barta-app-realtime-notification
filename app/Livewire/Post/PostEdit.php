<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\PostForm;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class PostEdit extends Component
{
    use WithFileUploads;
    public $post;
    public PostForm $form;
    public function mount($post)
    {
        $this->post = Post::findOrFail($post);
        $this->form->body = $this->post->body;
        // $this->form->picture = $this->post->picture;
    }
    public function editPost(){
        $this->validate();
        if ($this->form->picture) {
            if ($this->post->picture) {
                Storage::disk('public')->delete($this->post->picture);
            }
            $picturePath = $this->form->picture->store('pictures', 'public');
        }else{
            $picturePath = $this->post->picture;
        }

        $updatedPost = $this->post->update([
            "body" => $this->form->body,
            "picture" => $picturePath,
        ]);

        if($updatedPost){
            session()->flash('success', 'Post updated successfully.');
            return redirect()->route('dashboard');
        }else{
            session()->flash('error','post is not updated!');
        }


    }


    public function render()
    {
        return view('livewire.post.post-edit');
    }
}
