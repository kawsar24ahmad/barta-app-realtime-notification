<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout extends Component
{
    public function logout(){
        Session::flush();
        Auth::logout();
        session()->flash("success","You are Logged out successfully");
        return redirect(route("login"));
    }
    public function render()
    {
        return view('livewire.auth.logout');
    }
}
