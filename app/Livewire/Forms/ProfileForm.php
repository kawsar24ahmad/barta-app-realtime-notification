<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfileForm extends Form
{

    #[Validate('nullable|image|mimes:jpg,jpeg,png|max:2048')]
    public $avatar;
    #[Validate('required|string')]
    public $first_name;
     #[Validate('required|string')]
    public $last_name;

    #[Validate('email')]
    public $email;
     #[Validate('nullable|min:8')]
    public $password;
    #[Validate('nullable|string')]
    public $bio;
}
