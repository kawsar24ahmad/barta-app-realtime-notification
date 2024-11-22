<?php
namespace App\Livewire\Admin;

use App\Livewire\Forms\PostForm;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Pagination\Cursor;
use Livewire\Attributes\Validate;
use Illuminate\Support\Collection;

class Dashboard extends Component
{

    #[Title("Dashboard")]



    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
