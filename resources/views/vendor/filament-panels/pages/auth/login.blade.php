<x-filament-panels::page.simple>
    {{-- Show errors --}}
    @if ($errors->any())
        <div class="text-red-600 mb-3">
            {{ $errors->first('email') }}
        </div>
    @endif

    {{-- Registration link --}}
    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}
            {{ $this->registerAction }}
        </x-slot>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook(
        \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
        scopes: $this->getRenderHookScopes()
    ) }}

    <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()" />

        <div class="mt-4 text-center">
            <a href="{{ route('forgot-password.show') }}" class="text-primary-600 hover:text-primary-500 font-medium">
                Forgot your password?
            </a>
        </div>

        <div class="mt-2 text-sm text-gray-600 text-center">
            <span>Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-500">
                Register
            </a>
        </div>
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(
        \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
        scopes: $this->getRenderHookScopes()
    ) }}
</x-filament-panels::page.simple>
