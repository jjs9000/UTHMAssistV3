<?php

namespace App\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;

class Form extends Component
{
    public $name;
    public $description;

    protected $messages = [
        'name.required' => 'The tag name is required.',
        'name.string' => 'The tag name must be in type string.',
        'name.max' => 'The tag name is too long. Maximum 15 characters',

        'description.string' => 'The tag description must be in type string.',
        'description.max' => 'The tag description is too long. Maximum 50 characters.',
    ];

    public function submit()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ];

        $this->validate($rules);

        Tag::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Tag successfully created.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.tag.form');
    }
}
