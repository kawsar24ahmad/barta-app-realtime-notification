<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    #[Validate("nullable|string|required_without:picture")]
    public $body;
    #[Validate('nullable|image|mimes:jpg,jpeg,png|max:2048|required_without:body')]
    public $picture;
}
