<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Roles;

use App\Http\Livewire\Base;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function add_user_log;
use function flash;
use function redirect;
use function view;

class Edit extends Base
{
    public ?Role $role       = null;
    public       $name      = '';
    public       $permission = [];

    protected function rules(): array
    {
        return [
            'name' => 'required|string|unique:roles,name,' . $this->role->id
        ];
    }

    protected array $messages = [
        'name.required' => 'Role is required'
    ];

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function mount(): void
    {
        $this->name = $this->role->name ?? '';

        if (isset($this->role->permissions)) {
            foreach ($this->role->permissions as $perm) {
                $this->permission[] = $perm->id;
            }
        }
    }

    public function render(): View
    {
        $permissions = Permission::all();
        return view('livewire.admin.roles.edit', ['permissions' => $permissions]);
    }

    public function update(): Redirector|RedirectResponse
    {
        $this->validate();

        $this->role->name  = strtolower(str_replace(' ', '_', $this->name));

        //sync given permissions
        $permissions = $this->permission;

        if ($permissions !== null) {
            $this->role->syncPermissions($permissions);
        }

        $this->role->save();

        add_user_log([
            'title'        => 'updated role ' . $this->name,
            'link'         => route('admin.settings.roles.edit', ['role' => $this->role->id]),
            'reference_id' => $this->role->id,
            'section'      => 'Roles',
            'type'         => 'Update'
        ]);

        flash('Grupo do Usuário Atualizado')->success();

        return redirect()->route('admin.settings.roles.index');
    }
}
