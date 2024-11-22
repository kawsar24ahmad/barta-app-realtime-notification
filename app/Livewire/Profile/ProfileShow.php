<?php

namespace App\Livewire\Profile;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class ProfileShow extends Component
{
    public $author;
    public function mount($id)  {
        $this->author = User::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.profile.profile-show');
    }
}
