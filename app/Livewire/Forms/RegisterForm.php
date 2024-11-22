<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate("required|string")]
    public $first_name;
    #[Validate("required|string")]
    public $last_name;
    #[Validate("required|email|unique:users,email")]
    public $email;
    #[Validate("required|min:4")]
    public $password;
}
