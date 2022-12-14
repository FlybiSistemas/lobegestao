<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Http\Livewire\Base;
use Illuminate\Contracts\View\View;

class Settings extends Base
{
    public function render(): View
    {
        return view('livewire.admin.settings.settings');
    }
}
