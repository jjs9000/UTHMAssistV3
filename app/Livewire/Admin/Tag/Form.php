<?php

namespace App\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;

class Form extends Component
{
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
    ];

    public function submit()
    {
        $this->validate();

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
