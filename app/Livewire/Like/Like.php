<?php

namespace App\Livewire\Like;

use App\Models\Post;
use App\Events\NotificationEvent;
use Livewire\Component;
use App\Notifications\LikeAddedNotification;
use Illuminate\Support\Facades\Notification;

class Like extends Component
{
    public $post;
    public $liked = false;
    public function mount(Post $post)  {
        $this->post = $post;
        $this->liked = $this->post->usersWhoLiked()->where('user_id',auth()->user()->id)->exists();
    }
    public function toggleLike(){
        if ($this->liked) {
            $this->post->usersWhoLiked()->detach(auth()->user()->id);
        }else{
            $this->post->usersWhoLiked()->attach(auth()->user()->id);
            $author = $this->post->author;


            Notification::send($author, new LikeAddedNotification(auth()->user(), $this->post));
        }
         $this->liked = !$this->liked;

    }
    public function render()
    {
        return view('livewire.like.like');
    }
}
