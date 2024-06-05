<?php

namespace App\Livewire;

use App\Events\TestEvent;
use Livewire\Component;

class TestComponent extends Component
{
    protected $listeners = ['echo:notification-channel,TestEvent' => 'notify'];

    public $message;

    public function notify($data)
    {
        $this->message = $data['message'];
    }

    public function notifyTest()
    {
        event(new TestEvent('This is a test notification.'));
    }

    public function render()
    {
        return view('livewire.test-component');
    }
}
