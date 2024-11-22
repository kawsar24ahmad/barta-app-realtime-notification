<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use App\Http\Resources\PostResource;
use App\Http\Resources\AdminResource;

class Profile extends Component
{
    public $authUser;
    public $posts;

    public function mount(){
        $this->authUser = User::find(auth()->user()->id);
        $this->posts = $this->authUser->posts()->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.admin.profile');
    }
}
