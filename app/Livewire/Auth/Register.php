<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\RegisterForm;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Title("Register Page")]

    public RegisterForm $form;


    public function register()  {
        $this->validate();
        $user = User::create([
            "first_name"=> $this->form->first_name,
            "last_name"=> $this->form->last_name,
            "email"=> $this->form->email,
            "password"=> Hash::make($this->form->password),
        ]);

        session()->flash('message',"Registration is successfull!");

        return redirect()->route("login");

    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
