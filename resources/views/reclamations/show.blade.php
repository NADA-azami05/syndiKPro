@extends('layouts.app')
@section('title', 'Réclamation #' . str_pad($reclamation->id, 4, '0', STR_PAD_LEFT))

@push('styles')
    <style>
        :root {
            --blue: #006AD7;
            --navy: #1e3a5f;
            --bg: #f5f7ff;
            --border: #e8ecf4;
            --text: #111827;
            --muted: #6b7280;
        }

        .rs-page {
            padding: 32px 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ── Retour ── */
        .rs-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--blue);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 24px;
            transition: gap .2s;
        }

        .rs-back:hover {
            gap: 12px;
        }

        /* ── Grid 2 colonnes ── */
        .rs-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 24px;
            align-items: start;
        }

        /* ── Carte générique ── */
        .rs-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
            margin-bottom: 20px;
        }

        .rs-card:last-child {
            margin-bottom: 0;
        }

        .rs-card-head {
            padding: 14px 20px;
            font-size: 13px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            border-bottom: 1px solid var(--border);
            background: #f8fafd;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .rs-card-body {
            padding: 20px;
        }

        /* ── Réclamation principale ── */
        .rs-recl-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
            gap: 16px;
        }

        .rs-recl-titre {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .rs-recl-ref {
            font-size: 12px;
            color: var(--muted);
            font-family: monospace;
        }

        .rs-recl-desc {
            font-size: 14px;
            color: #374151;
            line-height: 1.6;
            white-space: pre-line;
            background: #f8fafd;
            border-radius: 10px;
            padding: 16px;
        }

        /* Badges priorité */
        .prio-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .prio-normale {
            background: #f0f4ff;
            color: #3b5bdb;
        }

        .prio-urgente {
            background: #fff7ed;
            color: #d97706;
        }

        .prio-critique {
            background: #fef2f2;
            color: #dc2626;
        }

        /* ── Infos résident ── */
        .rs-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .rs-info-item label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .rs-info-item .val {
            font-size: 14px;
            font-weight: 500;
            color: var(--text);
        }

        /* Lot badge */
        .lot-badge {
            display: inline-block;
            padding: 3px 12px;
            background: #f0f4ff;
            color: var(--blue);
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
        }

        /* ── Colonne droite : traitement ── */
        .rs-treat-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
            position: sticky;
            top: 80px;
        }

        .rs-treat-head {
            padding: 16px 20px;
            background: var(--navy);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .rs-treat-body {
            padding: 20px;
        }

        /* Statut actuel */
        .rs-statut-current {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 10px;
            background: #f8fafd;
        }

        .statut-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
        }

        .s-en_attente {
            background: #fff7ed;
            color: #d97706;
        }

        .s-en_cours {
            background: #eff6ff;
            color: #2563eb;
        }

        .s-resolu {
            background: #f0fdf4;
            color: #16a34a;
        }

        .s-ferme {
            background: #f3f4f6;
            color: #6b7280;
        }

        /* Formulaire traitement */
        .rs-form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .rs-form-select,
        .rs-form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: var(--text);
            background: #fff;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .rs-form-select:focus,
        .rs-form-textarea:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(0, 106, 215, .10);
        }

        .rs-form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .rs-form-group {
            margin-bottom: 16px;
        }

        .btn-save {
            width: 100%;
            padding: 12px;
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: background .2s;
            margin-bottom: 10px;
        }

        .btn-save:hover {
            background: #162d4b;
        }

        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 100%;
            padding: 11px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            transition: all .2s;
        }

        .btn-back:hover {
            border-color: var(--blue);
            color: var(--blue);
        }

        /* ── Interventions ── */
        .rs-interv-table {
            width: 100%;
            border-collapse: collapse;
        }

        .rs-interv-table th {
            padding: 10px 14px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--muted);
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .rs-interv-table td {
            padding: 12px 14px;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
        }

        .rs-interv-table tr:last-child td {
            border-bottom: none;
        }

        /* ── Flash success ── */
        .rs-flash {
            background: #f0fdf4;
            border: 1px solid #86efac;
            color: #15803d;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="rs-page">

        <a href="{{ route('syndic.reclamations.index') }}" class="rs-back">← Retour aux réclamations</a>

        @if(session('success'))
            <div class="rs-flash">✅ {{ session('success') }}</div>
        @endif

        <div class="rs-grid">

            {{-- ── Colonne gauche ── --}}
            <div>

                {{-- Réclamation --}}
                <div class="rs-card">
                    <div class="rs-card-head">💬 Détail de la réclamation</div>
                    <div class="rs-card-body">
                        <div class="rs-recl-header">
                            <div>
                                <div class="rs-recl-titre">{{ $reclamation->titre }}</div>
                                <div class="rs-recl-ref">
                                    Réf. #RC-{{ str_pad($reclamation->id, 4, '0', STR_PAD_LEFT) }}
                                    &nbsp;·&nbsp;
                                    {{ $reclamation->created_at->format('d/m/Y à H:i') }}
                                </div>
                            </div>
                            @php $prioIco = ['normale' => '🟢', 'urgente' => '🟡', 'critique' => '🔴'] @endphp
                            <span class="prio-badge prio-{{ $reclamation->priorite }}">
                                {{ $prioIco[$reclamation->priorite] ?? '' }}
                                {{ ucfirst($reclamation->priorite) }}
                            </span>
                        </div>
                        <div class="rs-recl-desc">{{ $reclamation->description }}</div>
                    </div>
                </div>

                {{-- Infos résident & lot --}}
                <div class="rs-card">
                    <div class="rs-card-head">👤 Informations résident</div>
                    <div class="rs-card-body">
                        <div class="rs-info-grid">
                            <div class="rs-info-item">
                                <label>Nom complet</label>
                                <div class="val">{{ $reclamation->resident->user->name }}</div>
                            </div>
                            <div class="rs-info-item">
                                <label>Email</label>
                                <div class="val">{{ $reclamation->resident->user->email }}</div>
                            </div>
                            <div class="rs-info-item">
                                <label>Téléphone</label>
                                <div class="val">{{ $reclamation->resident->telephone ?? '—' }}</div>
                            </div>
                            <div class="rs-info-item">
                                <label>Type de résidence</label>
                                <div class="val">{{ ucfirst($reclamation->resident->type ?? '—') }}</div>
                            </div>
                            <div class="rs-info-item">
                                <label>Lot</label>
                                <div class="val">
                                    <span class="lot-badge">{{ $reclamation->resident->lot->numero }}</span>
                                    &nbsp;{{ ucfirst($reclamation->resident->lot->type) }}
                                    @if($reclamation->resident->lot->surface)
                                        &nbsp;({{ $reclamation->resident->lot->surface }} m²)
                                    @endif
                                </div>
                            </div>
                            <div class="rs-info-item">
                                <label>Copropriété</label>
                                <div class="val">{{ $reclamation->resident->lot->copropriete->nom }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Interventions liées --}}
                @if($reclamation->interventions->count())
                    <div class="rs-card">
                        <div class="rs-card-head">🔧 Interventions liées</div>
                        <div style="padding:0">
                            <table class="rs-interv-table">
                                <thead>
                                    <tr>
                                        <th style="padding-left:20px">Fournisseur</th>
                                        <th>Date</th>
                                        <th>Coût</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reclamation->interventions as $i)
                                        <tr>
                                            <td style="padding-left:20px;font-weight:600">{{ $i->fournisseur->nom }}</td>
                                            <td>{{ $i->date_intervention->format('d/m/Y') }}</td>
                                            <td>{{ number_format($i->cout, 2, ',', ' ') }} MAD</td>
                                            <td>
                                                <span
                                                    style="background:#e0f2fe;color:#0369a1;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600">
                                                    {{ $i->statut }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

            </div>

            {{-- ── Colonne droite : traitement ── --}}
            <div>
                <div class="rs-treat-card">
                    <div class="rs-treat-head">✏️ Traiter la réclamation</div>
                    <div class="rs-treat-body">

                        {{-- Statut actuel --}}
                        @php
                            $statutLabels = [
                                'en_attente' => 'En attente',
                                'en_cours' => 'En cours',
                                'resolu' => 'Résolue',
                                'ferme' => 'Fermée',
                            ];
                         @endphp
                        <div class="rs-statut-current">
                            <div
                                style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#9ca3af;margin-bottom:6px">
                                Statut actuel
                            </div>
                            <span class="statut-pill s-{{ $reclamation->statut }}">
                                {{ $statutLabels[$reclamation->statut] ?? $reclamation->statut }}
                            </span>
                        </div>

                        <form method="POST" action="{{ route('syndic.reclamations.statut', $reclamation) }}">
                            @csrf

                            <div class="rs-form-group">
                                <label class="rs-form-label">Nouveau statut</label>
                                <select name="statut" class="rs-form-select" required>
                                    <option value="en_attente" {{ $reclamation->statut === 'en_attente' ? 'selected' : '' }}>⏳
                                        En attente</option>
                                    <option value="en_cours" {{ $reclamation->statut === 'en_cours' ? 'selected' : '' }}>
                                        🔧 En cours</option>
                                    <option value="resolu" {{ $reclamation->statut === 'resolu' ? 'selected' : '' }}>✅
                                        Résolu</option>
                                    <option value="ferme" {{ $reclamation->statut === 'ferme' ? 'selected' : '' }}>🔒
                                        Fermé</option>
                                </select>
                            </div>

                            <div class="rs-form-group">
                                <label class="rs-form-label">Réponse au résident</label>
                                <textarea name="reponse" class="rs-form-textarea"
                                    placeholder="Expliquez les actions prises, délais prévus...">{{ $reclamation->reponse }}</textarea>
                            </div>

                            <button type="submit" class="btn-save">💾 Enregistrer</button>
                        </form>

                        <a href="{{ route('syndic.reclamations.index') }}" class="btn-back">
                            ← Retour à la liste
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection