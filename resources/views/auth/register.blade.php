<x-base-layout>

<style>
.reg *:not(i) { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

.reg-wrap {
    min-height: calc(100vh - 200px);
    background: var(--color-header-bg, #f5f0e8);
    display: flex; align-items: center; justify-content: center;
    padding: 48px 24px;
}
.reg-card {
    background: #fff; border: 1px solid #ece9e3;
    border-radius: 20px; padding: 44px 40px;
    width: 100%; max-width: 440px;
}
.reg-card__titel {
    font-size: 26px; font-weight: 900;
    color: #1a1a1a; letter-spacing: -0.03em;
    margin: 0 0 6px;
}
.reg-card__sub {
    font-size: 14px; color: #6b7280;
    margin: 0 0 32px; line-height: 1.6;
}
.reg-field { display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px; }
.reg-label {
    font-size: 12px; font-weight: 700; color: #1a1a1a;
    letter-spacing: 0.06em; text-transform: uppercase;
}
.reg-input {
    background: #f9f7f3; border: 1.5px solid #ece9e3;
    border-radius: 10px; padding: 12px 16px;
    font-size: 14px; color: #1a1a1a;
    font-family: 'Plus Jakarta Sans', sans-serif;
    outline: none; transition: border-color 0.18s; width: 100%;
}
.reg-input:focus { border-color: #8b7355; }
.reg-error { font-size: 12px; color: #991b1b; }
.reg-btn {
    width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px;
    background: #1a1a1a; color: #fff; border: none; cursor: pointer;
    font-size: 14px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 14px 24px; border-radius: 50px; letter-spacing: 0.03em;
    transition: background 0.18s, transform 0.18s; margin-top: 8px;
}
.reg-btn:hover { background: #333; transform: translateY(-2px); }
.reg-back {
    display: block; text-align: center; margin-top: 20px;
    font-size: 13px; color: #8b7355; text-decoration: none;
    font-weight: 600;
}
.reg-back:hover { color: #1a1a1a; }
</style>

<div class="reg-wrap">
    <div class="reg-card">
        <h1 class="reg-card__titel">Account aanmaken</h1>
        <p class="reg-card__sub">Maak het beheerdersaccount aan. Na registratie is deze pagina niet meer toegankelijk.</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="reg-field">
                <label class="reg-label" for="name">Naam</label>
                <input type="text" name="name" id="name" class="reg-input"
                       value="{{ old('name') }}" required autofocus autocomplete="name"
                       placeholder="Jan Jansen">
                @error('name')<span class="reg-error">{{ $message }}</span>@enderror
            </div>

            <div class="reg-field">
                <label class="reg-label" for="email">E-mailadres</label>
                <input type="email" name="email" id="email" class="reg-input"
                       value="{{ old('email') }}" required autocomplete="username"
                       placeholder="jan@bedrijf.nl">
                @error('email')<span class="reg-error">{{ $message }}</span>@enderror
            </div>

            <div class="reg-field">
                <label class="reg-label" for="password">Wachtwoord</label>
                <input type="password" name="password" id="password" class="reg-input"
                       required autocomplete="new-password" placeholder="Minimaal 8 tekens">
                @error('password')<span class="reg-error">{{ $message }}</span>@enderror
            </div>

            <div class="reg-field">
                <label class="reg-label" for="password_confirmation">Wachtwoord bevestigen</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="reg-input" required autocomplete="new-password"
                       placeholder="Herhaal wachtwoord">
                @error('password_confirmation')<span class="reg-error">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="reg-btn">
                Account aanmaken <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <a href="{{ route('login') }}" class="reg-back">Al een account? Inloggen</a>
    </div>
</div>

</x-base-layout>
