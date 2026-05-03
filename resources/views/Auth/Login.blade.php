@extends('layouts.app')
@section('title', 'Connexion')

@push('styles')
<style>
.auth-page {
    min-height: calc(100vh - 68px);
    display: grid; grid-template-columns: 1fr 1fr;
}

/* ── Panneau gauche (visuel) ── */
.auth-visual {
    position: relative; overflow: hidden;
    background: transparent;
    display: flex; align-items: center; justify-content: center; padding: 60px;
}
.auth-visual-bg {
    position: absolute; inset: 0;
    background: url('{{ asset('images/hero_auth.jpg') }}') center/cover no-repeat;
     opacity: 1; 
}
.auth-visual-overlay {
    position: absolute; inset: 0;
     background: linear-gradient(145deg, rgba(0,0,0,0.45), rgba(0,0,0,0.20));
}
.auth-visual-content { position: relative; z-index: 2; color: #fff; }
.auth-visual-logo {
    display: flex; align-items: center; gap: 10px;
    font-size: 20px; font-weight: 500; margin-bottom: 60px;
}
.auth-visual-logo .icon {
    width: 40px; height: 40px; background: var(--orange);
    border-radius: 10px; display: grid; place-items: center; font-size: 18px;
}
.auth-visual-content h2 {
    font-family: var(--font-serif); font-size: 38px; font-weight: 700;
    line-height: 1.15; margin-bottom: 18px;
}
.auth-visual-content h2 em { font-style: italic; color: var(--orange); }
.auth-visual-content p {
    font-size: 15px; color: rgba(255,255,255,0.55);
    line-height: 1.75; font-weight: 300; max-width: 360px;
}
.auth-features { margin-top: 48px; display: flex; flex-direction: column; gap: 16px; }
.auth-feature { display: flex; align-items: center; gap: 14px; }
.auth-feature-icon {
    width: 36px; height: 36px; background: rgba(255,255,255,0.08);
    border-radius: 8px; display: grid; place-items: center; font-size: 15px; flex-shrink: 0;
}
.auth-feature p { font-size: 13px; color: rgba(255,255,255,0.60); font-weight: 300; }

/* ── Panneau droit (formulaire) ── */
.auth-form-panel {
    background: var(--bg); display: flex;
    align-items: center; justify-content: center; padding: 60px;
}
.auth-card {
    width: 100%; max-width: 420px;
    background: var(--bg-white); border: 1px solid var(--border);
    border-radius: var(--radius-lg); padding: 44px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.06);
}
.auth-card-header { margin-bottom: 32px; }
.auth-card-header h1 {
    font-family: var(--font-serif); font-size: 26px; font-weight: 700;
    color: var(--navy); margin-bottom: 6px;
}
.auth-card-header p { font-size: 14px; color: var(--text-muted); font-weight: 300; }

.form-group { margin-bottom: 20px; }
.form-group label {
    display: block; font-size: 12px; font-weight: 500; letter-spacing: 0.5px;
    text-transform: uppercase; color: var(--text-muted); margin-bottom: 8px;
}
.form-control {
    width: 100%; padding: 13px 16px;
    background: var(--bg); border: 1px solid var(--border);
    border-radius: 10px; font-size: 14px; color: var(--navy);
    font-family: var(--font-sans); outline: none;
    transition: border-color .2s, box-shadow .2s;
}
.form-control:focus {
    border-color: var(--orange);
    box-shadow: 0 0 0 3px rgba(212,136,42,0.12);
}
.form-control::placeholder { color: var(--text-light); font-weight: 300; }
.form-control.is-invalid { border-color: #ef4444; }

.invalid-feedback { font-size: 12px; color: #ef4444; margin-top: 6px; }

.form-check {
    display: flex; align-items: center; gap: 10px; margin-bottom: 24px;
}
.form-check input[type="checkbox"] {
    width: 16px; height: 16px; accent-color: var(--orange); cursor: pointer;
}
.form-check label { font-size: 13px; color: var(--text-muted); cursor: pointer; }

.forgot-link {
    font-size: 13px; color: var(--orange); text-decoration: none;
    float: right; margin-top: -28px; margin-bottom: 24px;
    display: block; text-align: right;
}
.forgot-link:hover { text-decoration: underline; }

.btn-submit {
    width: 100%; padding: 14px;
    background: var(--orange); color: #fff;
    border: none; border-radius: 10px;
    font-size: 15px; font-weight: 500; cursor: pointer;
    font-family: var(--font-sans);
    transition: background .2s, transform .15s;
}
.btn-submit:hover { background: #b8741f; transform: translateY(-1px); }

.auth-footer {
    text-align: center; margin-top: 24px;
    font-size: 13px; color: var(--text-muted);
}
.auth-footer a { color: var(--orange); text-decoration: none; font-weight: 500; }
.auth-footer a:hover { text-decoration: underline; }
</style>
@endpush

@section('content')
<div class="auth-page">

    {{-- Panneau visuel gauche --}}
    <div class="auth-visual">
        <div class="auth-visual-bg"></div>
        <div class="auth-visual-overlay"></div>
        <div class="auth-visual-content">
            <div class="auth-visual-logo">
                <div class="icon">🏢</div>
                SyndicPro
            </div>
            <h2>Gérez votre<br>copropriété <em>simplement</em></h2>
            <p>Une plateforme complète pour les syndics et les résidents. Sécurisée, intuitive et disponible 24h/24.</p>
            <div class="auth-features">
                <div class="auth-feature">
                    <div class="auth-feature-icon">💳</div>
                    <p>Paiements en ligne sécurisés via Stripe</p>
                </div>
                <div class="auth-feature">
                    <div class="auth-feature-icon">📋</div>
                    <p>Gestion des réclamations en temps réel</p>
                </div>
                <div class="auth-feature">
                    <div class="auth-feature-icon">🗳️</div>
                    <p>Votes et assemblées générales en ligne</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Formulaire droit --}}
    <div class="auth-form-panel">
        <div class="auth-card">
            <div class="auth-card-header">
                <h1>Bon retour 👋</h1>
                <p>Connectez-vous à votre espace SyndicPro</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="votre@email.com"
                        autocomplete="email"
                        autofocus
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <a href="#" class="forgot-link">Mot de passe oublié ?</a>

                <div class="form-check">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Se souvenir de moi</label>
                </div>

                <button type="submit" class="btn-submit">Se connecter</button>
            </form>

            <p class="auth-footer">
                Pas encore de compte ?
                <a href="{{ route('register') }}">Créer un compte</a>
            </p>
        </div>
    </div>

</div>
@endsection