<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Base;
use App\Models\User;
use Illuminate\Contracts\View\View;

use function view;

class EditUser extends Base
{
    public User $user;

    public function mount()
    {
        parent::mount();
    }

    public function render(): View
    {
        return view('livewire.admin.users.edit');
    }
}
