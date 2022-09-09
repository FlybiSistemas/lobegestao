<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Users\Edit;

use App\Http\Livewire\Base;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Role;

use function add_user_log;
use function flash;
use function is_admin;
use function view;

class Roles extends Base
{
    public User $user;
    public      $roleSelections = [];
    public      $adminRoles     = [];

    public function mount(): void
    {
        $this->roleSelections = $this->user->roles->pluck('id')->toArray();
    }

    public function render(): View
    {
        $roles = Role::orderby('name')->get();

        return view('livewire.admin.users.edit.roles', compact('roles'))->layout('layouts.app');
    }

    public function update(): bool
    {
        $this->syncRoles();
        return true;
    }

    protected function syncRoles(): void
    {
        $this->user->roles()->sync($this->roleSelections);
        $this->user->save();

        add_user_log([
            'title'        => "updated " . $this->user->name . "'s roles",
            'reference_id' => $this->user->id,
            'link'         => route('admin.users.edit', ['user' => $this->user->id]),
            'section'      => 'Users',
            'type'         => 'Update'
        ]);

        flash('Roles Updated!')->success();
    }
}
