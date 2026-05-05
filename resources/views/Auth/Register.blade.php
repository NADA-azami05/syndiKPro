@extends('layouts.app')
@section('title', 'Créer un compte')

@push('styles')
<style>
.auth-page {
    min-height: calc(100vh - 68px);
    position: relative;
    display: flex;
    align-items: center;
    overflow: hidden;
}
.auth-bg {
    position: absolute; inset: 0; z-index: 0;
    background: url('/images/hero_home.jpg') center/cover no-repeat;
    filter: blur(2px);
    transform: scale(1.05);
}
.auth-bg-overlay {
    position: absolute; inset: 0; z-index: 1;
    background: rgba(240,244,255,0.55);
}
.auth-inner {
    position: relative; z-index: 2;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px; align-items: center;
    width: 100%; padding: 60px 80px;
}

/* Texte gauche */
.auth-text { color: #111111; }
.auth-text .logo { display: flex; align-items: center; gap: 10px; font-size: 20px; font-weight: 600; margin-bottom: 40px; color: #111; }
.auth-text .logo .icon { width: 42px; height: 42px; background: #006AD7; border-radius: 10px; display: grid; place-items: center; font-size: 18px; }
.auth-text h2 { font-family: var(--font-serif); font-size: clamp(32px, 3.8vw, 48px); font-weight: 900; line-height: 1.1; margin-bottom: 16px; color: #111111; }
.auth-text h2 em { font-style: italic; color: #006AD7; }
.auth-text p { font-size: 15px; color: #444; line-height: 1.8; font-weight: 300; max-width: 380px; margin-bottom: 36px; }
.auth-steps { display: flex; flex-direction: column; gap: 18px; }
.auth-step { display: flex; align-items: flex-start; gap: 14px; }
.step-num { width: 32px; height: 32px; border-radius: 50%; background: #006AD7; color: #fff; display: grid; place-items: center; font-size: 13px; font-weight: 700; flex-shrink: 0; }
.step-text p:first-child { font-size: 14px; font-weight: 500; color: #111; }
.step-text p:last-child { font-size: 12px; color: #666; margin-top: 2px; }

/* Carte droite */
.auth-card { background: rgba(255,255,255,0.97); border-radius: 24px; padding: 48px; box-shadow: 0 24px 80px rgba(0,0,0,0.30); width: 100%; }
.auth-card-header { margin-bottom: 24px; }
.auth-card-header h1 { font-family: var(--font-serif); font-size: 26px; font-weight: 700; color: #111111; margin-bottom: 6px; }
.auth-card-header p { font-size: 14px; color: #6b7280; font-weight: 300; }
.role-badge { display: inline-flex; align-items: center; gap: 6px; background: #e6f2ff; color: #006AD7; border: 1px solid rgba(0,106,215,0.20); border-radius: 100px; padding: 6px 14px; font-size: 12px; font-weight: 500; margin-bottom: 20px; }
.form-group { margin-bottom: 16px; }
.form-group label { display: block; font-size: 11px; font-weight: 600; letter-spacing: 0.6px; text-transform: uppercase; color: #6b7280; margin-bottom: 7px; }
.form-control { width: 100%; padding: 13px 16px; background: #f0f4ff; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 14px; color: #111; font-family: var(--font-sans); outline: none; transition: border-color .2s, box-shadow .2s; }
.form-control:focus { border-color: #006AD7; box-shadow: 0 0 0 3px rgba(0,106,215,0.10); background: #fff; }
.form-control::placeholder { color: #c4c9d4; font-weight: 300; }
.form-control.is-invalid { border-color: #ef4444; }
.invalid-feedback { font-size: 12px; color: #ef4444; margin-top: 5px; }
.hint { font-size: 11px; color: #c4c9d4; margin-top: 5px; }
.btn-submit { width: 100%; padding: 14px; background: #006AD7; color: #fff; border: none; border-radius: 10px; font-size: 15px; font-weight: 500; cursor: pointer; font-family: var(--font-sans); transition: background .2s, transform .15s; margin-top: 6px; }
.btn-submit:hover { background: #0055b3; transform: translateY(-1px); }
.terms { font-size: 11px; color: #c4c9d4; text-align: center; margin-top: 12px; line-height: 1.6; }
.terms a { color: #006AD7; text-decoration: none; }
.auth-footer { text-align: center; margin-top: 18px; font-size: 14px; color: #6b7280; }
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
            <h2>Commencez à gérer<br>votre résidence <em>aujourd'hui</em></h2>
            <p>Créez votre compte syndic en moins de 2 minutes et invitez vos résidents directement depuis la plateforme.</p>
            <div class="auth-steps">
                <div class="auth-step"><div class="step-num">1</div><div class="step-text"><p>Créez votre compte syndic</p><p>Inscription rapide et sécurisée</p></div></div>
                <div class="auth-step"><div class="step-num">2</div><div class="step-text"><p>Configurez votre résidence</p><p>Ajoutez vos lots et informations</p></div></div>
                <div class="auth-step"><div class="step-num">3</div><div class="step-text"><p>Invitez vos résidents</p><p>Ils reçoivent leur accès par email</p></div></div>
            </div>
        </div>

        {{-- Carte droite --}}
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
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Mohamed Alami" autocomplete="name" autofocus required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="votre@email.com" autocomplete="email" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" autocomplete="new-password" required>
                    <p class="hint">Minimum 8 caractères</p>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••" autocomplete="new-password" required>
                </div>
                <button type="submit" class="btn-submit">Créer mon compte</button>
                <p class="terms">En créant un compte, vous acceptez nos <a href="#">Conditions</a> et notre <a href="#">Politique de confidentialité</a>.</p>
            </form>
            <p class="auth-footer">Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
        </div>

    </div>
</div>
@endsection