<?php

namespace App\Livewire\Comment;


use App\Models\Post;
use Livewire\Component;
use NotificationTestEvent;
use App\Events\TestNotification;
use App\Livewire\Forms\CommentForm;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CommentAddedNotification;

class CommentCreate extends Component
{
    public CommentForm $form;
    public $postId;

    public function mount($post_id){
        $this->postId = $post_id;
    }
    public function postComment(){
        $this->validate();
        // dd($this->postId);
        $comment =  auth()->user()->comments()->create([
            "comment" => $this->form->comment,
            "post_id" => $this->postId,
        ]);
        event(new TestNotification($comment));


        $author = Post::find($this->postId)->author;

        Notification::send($author, new CommentAddedNotification($comment, auth()->user()));

        session()->flash("success","Comment is added successfully");
        return redirect()->route("posts.show", $this->postId);
    }


    public function render()
    {

        return view('livewire.comment.comment-create');
    }
}
