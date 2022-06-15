<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Counter extends Component
{

    public $users;
    public $count = 10;
    public $message = 'message';

    public function mount()
    {
        $this->users = User::all();
    }

    public function increment()
    {
        $this->count++;
    }

    public function delUser(int $id)
    {
        $this->users = $this->users->filter(function ($value, $key) use ($id) {
            return $value['id']  != $id;
        });

        $user = User::find($id);

        $user->delete();
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
