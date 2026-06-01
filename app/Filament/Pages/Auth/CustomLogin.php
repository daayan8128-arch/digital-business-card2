<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Support\Facades\Hash;
use Filament\Facades\Filament;
use App\Models\User;

class CustomLogin extends BaseLogin
{
    public function authenticate(): \Filament\Http\Responses\Auth\Contracts\LoginResponse|null
    {
        $data = $this->form->getState();

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            $this->addError('email', __('filament-panels::pages/auth/login.messages.failed'));
            return null;
        }

        // === BLOCKED CHECK ===
        if ($user->isBlocked()) {
            $this->addError('email', 'Your account is blocked. Please contact admin.');
            return null;
        }

        Filament::auth()->login($user, $data['remember'] ?? false);

        session()->regenerate();

        return app(\Filament\Http\Responses\Auth\Contracts\LoginResponse::class);
    }
}
