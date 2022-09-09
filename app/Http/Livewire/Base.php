<?php

namespace App\Http\Livewire;

use App\Models\AuditTrail;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Base extends Component
{
    public function mount()
    {
        Paginator::defaultView('vendor/pagination/tailwind');
        Paginator::defaultSimpleView('vendor/pagination/simple-tailwind');

        //if user is logged in
        if (auth()->check()) {
            //if user is not active log the user out
            if (!Auth::user()->is_active) {
                flash('Your account has been deactivated. You cannot login.')->warning();

                AuditTrail::create([
                    'user_id'      => auth()->id(),
                    'reference_id' => auth()->id(),
                    'title'        => "force logged out account, inactive",
                    'section'      => 'Auth',
                    'type'         => 'Logout'
                ]);

                auth()->logout();

                redirect(route('login'));
            }
        } else {
            redirect(route('login'));
        }
    }
}
