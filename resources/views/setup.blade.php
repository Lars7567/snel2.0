<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup — Admin account aanmaken</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 24px;
        }
        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        }
        h1 {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0 0 6px;
            color: #111;
        }
        p.sub {
            font-size: 0.88rem;
            color: #888;
            margin: 0 0 28px;
        }
        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }
        input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s;
            margin-bottom: 18px;
        }
        input:focus { border-color: #111; }
        .error {
            color: #dc2626;
            font-size: 0.8rem;
            margin: -12px 0 14px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        button:hover { background: #333; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Setup</h1>
        <p class="sub">Maak het eerste admin account aan. Deze pagina werkt alleen als er nog geen gebruikers zijn.</p>

        <form method="POST" action="/setup">
            @csrf

            <label for="name">Naam</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            @error('name') <p class="error">{{ $message }}</p> @enderror

            <label for="email">E-mailadres</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email') <p class="error">{{ $message }}</p> @enderror

            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" required>
            @error('password') <p class="error">{{ $message }}</p> @enderror

            <label for="password_confirmation">Wachtwoord bevestigen</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit">Account aanmaken</button>
        </form>
    </div>
</body>
</html>
