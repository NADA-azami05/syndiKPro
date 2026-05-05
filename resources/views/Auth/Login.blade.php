@extends('layouts.app')
@section('title', 'Connexion')

@push('styles')
<style>
.auth-page {
    min-height: calc(100vh - 68px);
    position: relative;
    display: flex;
    align-items: center;
    overflow: hidden;
}

/* Image bg floutée et foncée */
.auth-bg {
    position: absolute; inset: 0; z-index: 0;
    background: url('/images/hero_home.jpg') center/cover no-repeat;
    filter: blur(2px);
    transform: scale(1.05);
}
.auth-bg-overlay {
    position: absolute; inset: 0; z-index: 1;
    background: rgba(240,244,255,0.55); /* bleu clair assorti au header */
}

/* Layout 2 colonnes */
.auth-inner {
    position: relative; z-index: 2;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
    width: 100%;
    padding: 60px 80px;
}

/* ── Texte gauche ── */
.auth-text { color: #111111; }

.auth-text h2 {
    font-family: var(--font-serif);
    font-size: clamp(34px, 4vw, 52px);
    font-weight: 900; line-height: 1.1; margin-bottom: 18px;
    color: #111111;
}
.auth-text h2 em { font-style: italic; color: #006AD7; }

.auth-text p {
    font-size: 16px; color: #444;
    line-height: 1.8; font-weight: 300; max-width: 380px;
    margin-bottom: 40px;
}

.auth-feats { display: flex; flex-direction: column; gap: 18px; }
.auth-feat { display: flex; align-items: center; gap: 14px; }
.auth-feat-icon {
    width: 40px; height: 40px;
    background: #e6f2ff;
    border-radius: 10px; display: grid; place-items: center;
    font-size: 17px; flex-shrink: 0;
}
.auth-feat p { font-size: 14px; color: #333; font-weight: 400; }

/* ── Carte droite ── */
.auth-card {
    background: rgba(255,255,255,0.97);
    border-radius: 24px;
    padding: 52px 48px;
    box-shadow: 0 24px 80px rgba(0,0,0,0.30);
    width: 100%;
}

.auth-card-header { margin-bottom: 30px; }
.auth-card-header h1 {
    font-family: var(--font-serif); font-size: 28px;
    font-weight: 700; color: #111111; margin-bottom: 6px;
}
.auth-card-header p { font-size: 14px; color: #6b7280; font-weight: 300; }

.form-group { margin-bottom: 20px; }
.form-group label {
    display: block; font-size: 11px; font-weight: 600;
    letter-spacing: 0.6px; text-transform: uppercase;
    color: #6b7280; margin-bottom: 8px;
}
.form-control {
    width: 100%; padding: 14px 16px;
    background: #f0f4ff; border: 1px solid #e5e7eb;
    border-radius: 10px; font-size: 15px; color: #111;
    font-family: var(--font-sans); outline: none;
    transition: border-color .2s, box-shadow .2s;
}
.form-control:focus {
    border-color: #006AD7;
    box-shadow: 0 0 0 3px rgba(0,106,215,0.10);
    background: #fff;
}
.form-control::placeholder { color: #c4c9d4; font-weight: 300; }
.form-control.is-invalid { border-color: #ef4444; }
.invalid-feedback { font-size: 12px; color: #ef4444; margin-top: 6px; }

.form-row {
    display: flex; justify-content: space-between;
    align-items: center; margin-bottom: 24px;
}
.form-check { display: flex; align-items: center; gap: 8px; }
.form-check input[type="checkbox"] { width: 16px; height: 16px; accent-color: #006AD7; cursor: pointer; }
.form-check label { font-size: 13px; color: #6b7280; cursor: pointer; }
.forgot-link { font-size: 13px; color: #006AD7; text-decoration: none; }
.forgot-link:hover { text-decoration: underline; }

.btn-submit {
    width: 100%; padding: 15px;
    background: #006AD7; color: #fff; border: none;
    border-radius: 10px; font-size: 15px; font-weight: 500;
    cursor: pointer; font-family: var(--font-sans);
    transition: background .2s, transform .15s;
}
.btn-submit:hover { background: #0055b3; transform: translateY(-1px); }

.auth-footer {
    text-align: center; margin-top: 22px;
    font-size: 14px; color: #6b7280;
}
.auth-footer a { color: #006AD7; text-decoration: none; font-weight: 500; }
.auth-footer a:hover { text-decoration: underline; }
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-bg"></div>
    <div class="auth-bg-overlay"></div>

    <div class="auth-inner">

        {{-- Texte gauche --}}
        <div class="auth-text">
            <h2>Gérez votre<br>copropriété <em>simplement</em></h2>
            <p>Une plateforme complète pour syndics et résidents. Sécurisée, intuitive et disponible 24h/24.</p>
            <div class="auth-feats">
                <div class="auth-feat"><div class="auth-feat-icon">💳</div><p>Paiements en ligne sécurisés via Stripe</p></div>
                <div class="auth-feat"><div class="auth-feat-icon">📋</div><p>Gestion des réclamations en temps réel</p></div>
                <div class="auth-feat"><div class="auth-feat-icon">🗳️</div><p>Votes et assemblées générales en ligne</p></div>
            </div>
        </div>

        {{-- Carte droite --}}
        <div class="auth-card">
            <div class="auth-card-header">
                <h1>Bon retour 👋</h1>
                <p>Connectez-vous à votre espace SyndicPro</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="votre@email.com"
                        autocomplete="email" autofocus required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="••••••••" autocomplete="current-password" required>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-row">
                    <div class="form-check">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Se souvenir de moi</label>
                    </div>
                    <a href="#" class="forgot-link">Mot de passe oublié ?</a>
                </div>
                <button type="submit" class="btn-submit">Se connecter</button>
            </form>
            <p class="auth-footer">
                Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a>
            </p>
        </div>

    </div>
</div>
@endsection