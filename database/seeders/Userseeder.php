@extends('layouts.app')
@section('title', 'Créer un compte')

@push('styles')
<style>
.auth-page {
    min-height: calc(100vh - 68px);
    display: grid; grid-template-columns: 1fr 1fr;
}
.auth-visual {
    position: relative; overflow: hidden;
    background: linear-gradient(145deg, #1a2340 0%, #2d3a5c 100%);
    display: flex; align-items: center; justify-content: center; padding: 60px;
}
.auth-visual-bg {
    position: absolute; inset: 0;
    background: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=900&q=80') center/cover no-repeat;
    opacity: 0.15; mix-blend-mode: luminosity;
}
.auth-visual-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(145deg, rgba(26,35,64,0.90), rgba(45,58,92,0.80));
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
    font-family: var(--font-serif); font-size: 36px; font-weight: 700;
    line-height: 1.2; margin-bottom: 18px;
}
.auth-visual-content h2 em { font-style: italic; color: var(--orange); }
.auth-visual-content p {
    font-size: 15px; color: rgba(255,255,255,0.55);
    line-height: 1.75; font-weight: 300; max-width: 360px; margin-bottom: 40px;
}
.auth-steps { display: flex; flex-direction: column; gap: 18px; }
.auth-step { display: flex; align-items: flex-start; gap: 14px; }
.step-num {
    width: 28px; height: 28px; border-radius: 50%;
    background: var(--orange); color: #fff;
    display: grid; place-items: center;
    font-size: 12px; font-weight: 700; flex-shrink: 0;
}
.step-text p:first-child { font-size: 14px; font-weight: 500; color: rgba(255,255,255,0.90); }
.step-text p:last-child { font-size: 12px; color: rgba(255,255,255,0.45); margin-top: 2px; font-weight: 300; }

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

.password-hint {
    font-size: 11px; color: var(--text-light); margin-top: 6px; font-weight: 300;
}

.role-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--orange-light); color: var(--orange);
    border: 1px solid rgba(212,136,42,0.25);
    border-radius: 100px; padding: 6px 14px; font-size: 12px;
    font-weight: 500; margin-bottom: 24px;
}

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

.terms {
    font-size: 11px; color: var(--text-light); text-align: center;
    margin-top: 16px; line-height: 1.6;
}
.terms a { color: var(--orange); text-decoration: none; }
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
            <h2>Commencez à gérer<br>votre résidence <em>aujourd'hui</em></h2>
            <p>Créez votre compte syndic en moins de 2 minutes et invitez vos résidents directement depuis la plateforme.</p>
            <div class="auth-steps">
                <div class="auth-step">
                    <div class="step-num">1</div>
                    <div class="step-text">
                        <p>Créez votre compte syndic</p>
                        <p>Inscription rapide et sécurisée</p>
                    </div>
                </div>
                <div class="auth-step">
                    <div class="step-num">2</div>
                    <div class="step-text">
                        <p>Configurez votre résidence</p>
                        <p>Ajoutez vos lots et informations</p>
                    </div>
                </div>
                <div class="auth-step">
                    <div class="step-num">3</div>
                    <div class="step-text">
                        <p>Invitez vos résidents</p>
                        <p>Ils reçoivent leur accès par email</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Formulaire droit --}}
    <div class="auth-form-panel">
        <div class="auth-card">
            <div class="auth-card-header">
                <h1>Créer un compte</h1>
                <p>Rejoignez SyndicPro dès maintenant</p>
            </div>

            <div class="role-badge">🏢 Compte Syndic</div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Mohamed Alami"
                        autocomplete="name"
                        autofocus
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
                        autocomplete="new-password"
                        required
                    >
                    <p class="password-hint">Minimum 8 caractères</p>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="••••••••"
                        autocomplete="new-password"
                        required
                    >
                </div>

                <button type="submit" class="btn-submit">Créer mon compte</button>

                <p class="terms">
                    En créant un compte, vous acceptez nos
                    <a href="#">Conditions d'utilisation</a> et notre
                    <a href="#">Politique de confidentialité</a>.
                </p>
            </form>

            <p class="auth-footer">
                Déjà un compte ?
                <a href="{{ route('login') }}">Se connecter</a>
            </p>
        </div>
    </div>

</div>
@endsection