<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class PostShow extends Component
{
    public $post;
    public function mount($post)
    {
        // dd($post);
        $this->post = Post::findOrFail($post);
    }
    public function deletePost($id){
        $post = Post::find($id);
        $post->delete();
        session()->flash('success','Post has been deleted');
        return redirect()->route('dashboard');
    }
    public function render()
    {

        return view('livewire.post.post-show');
    }
}
