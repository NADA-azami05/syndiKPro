@extends('layouts.app')
@section('title', 'Nouvelle Réclamation')

@push('styles')
    <style>
        body {
            background: #f5f7ff !important;
        }

        .cr-wrap {
            max-width: 680px;
            margin: 48px auto;
            padding: 0 24px;
        }

        .cr-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #006AD7;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 24px;
            transition: gap .2s;
        }

        .cr-back:hover {
            gap: 12px;
        }

        .cr-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e8ecf4;
            padding: 40px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, .06);
        }

        .cr-title {
            font-size: 22px;
            font-weight: 700;
            color: #111;
            margin-bottom: 6px;
        }

        .cr-sub {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 32px;
        }

        .cr-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .cr-input,
        .cr-select,
        .cr-textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: #111;
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        .cr-input:focus,
        .cr-select:focus,
        .cr-textarea:focus {
            border-color: #006AD7;
            box-shadow: 0 0 0 3px rgba(0, 106, 215, .10);
        }

        .cr-textarea {
            resize: vertical;
            min-height: 130px;
        }

        .cr-group {
            margin-bottom: 22px;
        }

        .cr-error {
            font-size: 12px;
            color: #dc2626;
            margin-top: 5px;
        }

        .cr-priorities {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .cr-prio-label {
            cursor: pointer;
        }

        .cr-prio-label input {
            display: none;
        }

        .cr-prio-card {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px 12px;
            text-align: center;
            transition: all .2s;
            background: #fff;
        }

        .cr-prio-label input:checked+.cr-prio-card.normale {
            border-color: #006AD7;
            background: #f0f6ff;
        }

        .cr-prio-label input:checked+.cr-prio-card.urgente {
            border-color: #d97706;
            background: #fff7ed;
        }

        .cr-prio-label input:checked+.cr-prio-card.critique {
            border-color: #dc2626;
            background: #fef2f2;
        }

        .cr-prio-card:hover {
            border-color: #006AD7;
        }

        .cr-prio-ico {
            font-size: 24px;
            margin-bottom: 6px;
        }

        .cr-prio-name {
            font-size: 13px;
            font-weight: 600;
            color: #111;
        }

        .cr-prio-desc {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
        }

        .cr-footer {
            display: flex;
            gap: 12px;
            margin-top: 32px;
        }

        .btn-submit {
            flex: 1;
            background: #006AD7;
            color: #fff;
            border: none;
            padding: 13px 24px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: background .2s;
        }

        .btn-submit:hover {
            background: #0055b3;
        }

        .btn-cancel {
            padding: 13px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            border: 1.5px solid #e5e7eb;
            background: #fff;
            color: #6b7280;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: border-color .2s;
        }

        .btn-cancel:hover {
            border-color: #006AD7;
            color: #006AD7;
        }
    </style>
@endpush

@section('content')
    <div class="cr-wrap">
        <a href="{{ route('resident.reclamations.mes') }}" class="cr-back">← Retour à mes réclamations</a>

        <div class="cr-card">
            <div class="cr-title">💬 Nouvelle réclamation</div>
            <div class="cr-sub">Décrivez votre problème, le syndic sera notifié immédiatement.</div>

            @if($errors->any())
                <div
                    style="background:#fef2f2;border:1px solid #fca5a5;color:#dc2626;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px;">
                    ⚠️ Veuillez corriger les erreurs ci-dessous.
                </div>
            @endif

            <form action="{{ route('resident.reclamations.store') }}" method="POST">
                @csrf

                {{-- Titre --}}
                <div class="cr-group">
                    <label class="cr-label">Titre de la réclamation <span style="color:#dc2626">*</span></label>
                    <input type="text" name="titre" class="cr-input" value="{{ old('titre') }}"
                        placeholder="Ex : Fuite d'eau dans le couloir du 2ème étage">
                    @error('titre')<div class="cr-error">{{ $message }}</div>@enderror
                </div>

                {{-- Priorité --}}
                <div class="cr-group">
                    <label class="cr-label">Niveau de priorité <span style="color:#dc2626">*</span></label>
                    <div class="cr-priorities">
                        <label class="cr-prio-label">
                            <input type="radio" name="priorite" value="normale" {{ old('priorite', 'normale') === 'normale' ? 'checked' : '' }}>
                            <div class="cr-prio-card normale">
                                <div class="cr-prio-ico">🟢</div>
                                <div class="cr-prio-name">Normale</div>
                                <div class="cr-prio-desc">Pas urgent</div>
                            </div>
                        </label>
                        <label class="cr-prio-label">
                            <input type="radio" name="priorite" value="urgente" {{ old('priorite') === 'urgente' ? 'checked' : '' }}>
                            <div class="cr-prio-card urgente">
                                <div class="cr-prio-ico">🟡</div>
                                <div class="cr-prio-name">Urgente</div>
                                <div class="cr-prio-desc">À traiter vite</div>
                            </div>
                        </label>
                        <label class="cr-prio-label">
                            <input type="radio" name="priorite" value="critique" {{ old('priorite') === 'critique' ? 'checked' : '' }}>
                            <div class="cr-prio-card critique">
                                <div class="cr-prio-ico">🔴</div>
                                <div class="cr-prio-name">Critique</div>
                                <div class="cr-prio-desc">Danger / immédiat</div>
                            </div>
                        </label>
                    </div>
                    @error('priorite')<div class="cr-error">{{ $message }}</div>@enderror
                </div>

                {{-- Description --}}
                <div class="cr-group">
                    <label class="cr-label">Description détaillée <span style="color:#dc2626">*</span></label>
                    <textarea name="description" class="cr-textarea"
                        placeholder="Décrivez le problème en détail : localisation, depuis quand, impact...">{{ old('description') }}</textarea>
                    @error('description')<div class="cr-error">{{ $message }}</div>@enderror
                </div>

                <div class="cr-footer">
                    <button type="submit" class="btn-submit">📤 Soumettre la réclamation</button>
                    <a href="{{ route('resident.reclamations.mes') }}" class="btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection