<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">

            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password">Nova senha</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">

            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Confirmar senha</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">

            @error('password_confirmation')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Redefinir senha</button>
    </form>
</x-guest-layout>
