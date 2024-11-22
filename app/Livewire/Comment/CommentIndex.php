<?php

namespace App\Livewire\Comment;

use App\Models\Post;
use Livewire\Component;

class CommentIndex extends Component
{
    public $post;
    public $comments;
    public function mount($post_id)  {
        $this->post = Post::findOrFail($post_id);
        $this->comments = $this->post->comments()->orderBy("created_at","desc")->get();
    }
    public function render()
    {
        return view('livewire.comment.comment-index');
    }
}
