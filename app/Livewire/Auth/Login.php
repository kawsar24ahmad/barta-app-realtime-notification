<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    #[Title("Login Page")]

    public LoginForm $form;
    public function login()  {
        $this->validate();
        // dd($this->form->toArray());
        $authUser = Auth::attempt($this->form->toArray());

        if ($authUser) {
            session()->flash("success", "Login successful!");
            return redirect()->route("dashboard");
        }else{
            session()->flash("error","Invalid credentials. Please try again.");
        }


        // dd("login successful");
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
