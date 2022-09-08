<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\JoinController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\TwoFaController;
use App\Http\Livewire\Admin\AuditTrails;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Roles\Edit;
use App\Http\Livewire\Admin\Roles\Roles;
use App\Http\Livewire\Admin\SentEmails\SentEmails;
use App\Http\Livewire\Admin\SentEmails\SentEmailsBody;
use App\Http\Livewire\Admin\Settings\Settings;
use App\Http\Livewire\Admin\Users\EditUser;
use App\Http\Livewire\Admin\Users\ShowUser;
use App\Http\Livewire\Admin\Users\Users;
use App\Http\Livewire\Atividades\Atividades;
use App\Http\Livewire\Atividades\EditAtividade;
use App\Http\Livewire\Departamentos\EditDepartamento;
use App\Http\Livewire\Departamentos\Departamentos;
use App\Http\Livewire\Empresas\EditEmpresa;
use App\Http\Livewire\Empresas\Empresas;
use App\Http\Livewire\Empresas\ShowEmpresa;
use App\Http\Livewire\Grupos\EditGrupo;
use App\Http\Livewire\Grupos\Grupos;
use App\Http\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class);

//unauthenticated
Route::middleware(['web', 'guest'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset/{token}', [ResetPasswordController::class, 'reset'])->name('password.reset.update');

    Route::get('join/{token}', [JoinController::class, 'index'])->name('join');
    Route::put('join/{id}', [JoinController::class, 'update'])->name('join.update');
});

//authenticated
Route::middleware(['web', 'auth', 'activeUser', 'IpCheckMiddleware'])->prefix('admin')->group(function () {
    Route::get('2fa', [TwoFaController::class, 'index'])->name('2fa');
    Route::post('2fa', [TwoFaController::class, 'update'])->name('2fa.update');
    Route::get('2fa-setup', [TwoFaController::class, 'setup'])->name('2fa-setup');
    Route::post('2fa-setup', [TwoFaController::class, 'setupUpdate'])->name('2fa-setup.update');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', Dashboard::class)->name('admin');

    Route::get('settings/audit-trails', AuditTrails::class)->name('admin.settings.audit-trails.index');
    Route::get('settings/sent-emails', SentEmails::class)->name('admin.settings.sent-emails');
    Route::get('settings/sent-emails-body/{id}', SentEmailsBody::class)->name('admin.settings.sent-emails.body');

    Route::get('users', Users::class)->name('admin.users.index');
    Route::get('users/{user}/edit', EditUser::class)->name('admin.users.edit');
    Route::get('users/{user}', ShowUser::class)->name('admin.users.show');
});
Route::middleware(['web', 'auth', 'activeUser', 'IpCheckMiddleware'])->group(function () {
    Route::get('grupos', Grupos::class)->name('grupos.index');
    Route::get('grupos/{grupo}/edit', EditGrupo::class)->name('grupos.edit');

    Route::get('departamentos', Departamentos::class)->name('departamentos.index');
    Route::get('departamentos/{departamento}/edit', EditDepartamento::class)->name('departamentos.edit');

    Route::get('empresas', Empresas::class)->name('empresas.index');
    Route::get('empresas/{empresa}/edit', EditEmpresa::class)->name('empresas.edit');
    Route::get('empresas/{empresa}', ShowEmpresa::class)->name('empresas.show');

    Route::get('atividades', Atividades::class)->name('atividades.index');
    Route::get('atividades/{atividade}/edit', EditAtividade::class)->name('atividades.edit');
});

//Admin only routes
Route::middleware(['web', 'auth', 'activeUser', 'IpCheckMiddleware', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('settings/system-settings', Settings::class)->name('admin.settings');
    Route::get('settings/roles', Roles::class)->name('admin.settings.roles.index');
    Route::get('settings/roles/{role}/edit', Edit::class)->name('admin.settings.roles.edit');
});
