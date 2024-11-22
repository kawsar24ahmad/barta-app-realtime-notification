<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Livewire\Forms\ProfileForm;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileEdit extends Component
{
    use WithFileUploads;

    #[Title('Profile Edit')]
    public $author;

    public  ProfileForm $form;

    public function mount($id)  {
        $this->author = User::findOrFail($id);
        $this->form->first_name = $this->author->first_name;
        $this->form->last_name = $this->author->last_name;
        $this->form->email = $this->author->email;
        $this->form->bio = $this->author->bio;
        $this->form->avatar = $this->author->avatar;
    }
    public function saveForm(){
        $this->validate();

        $this->author->first_name = $this->form->first_name;
        $this->author->last_name = $this->form->last_name;
        $this->author->email = $this->form->email;
        $this->author->bio = $this->form->bio;
        $this->author->password = $this->form->password ? Hash::make($this->form->password) :  $this->author->password;

        if ($this->form->avatar) {
            if ($this->author->avatar) {
                Storage::disk('public')->delete($this->author->avatar);
            }
            $avatarPath =  $this->form->avatar->store('avatars', 'public');
            $this->author->avatar = $avatarPath;
        }


        $this->author->save();
        $this->form->password = "";

        session()->flash('success', 'Profile updated successfully!');
    }
    public function render()
    {
        return view('livewire.profile.profile-edit');
    }
}
