@extends('Layouts.App')
@section('title', 'Notifications')

@push('styles')
<style>
.notif-wrap {
    max-width: 780px;
    margin: 40px auto;
    padding: 0 24px;
}

.notif-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}

.notif-title {
    font-size: 24px;
    font-weight: 700;
    color: #111;
}

.notif-sub {
    font-size: 13px;
    color: #6b7280;
    margin-top: 3px;
}

.btn-tout-lire {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f0f4ff;
    color: #006AD7;
    border: 1.5px solid #006AD7;
    padding: 8px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    font-family: inherit;
    transition: all .2s;
}

.btn-tout-lire:hover {
    background: #006AD7;
    color: #fff;
}

/* Carte notification */
.notif-card {
    background: #fff;
    border: 1px solid #e8ecf4;
    border-radius: 14px;
    padding: 16px 20px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    margin-bottom: 10px;
    transition: box-shadow .2s, border-color .2s;
    position: relative;
}

.notif-card:hover {
    box-shadow: 0 4px 20px rgba(0, 106, 215, .10);
    border-color: #c7d8f5;
}

.notif-card.non-lue {
    border-left: 4px solid #006AD7;
    background: #f8fbff;
}

.notif-ico {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: grid;
    place-items: center;
    font-size: 20px;
    flex-shrink: 0;
}

.ico-facture {
    background: #d1fae5;
}

.ico-reclamation {
    background: #fef3c7;
}

.ico-annonce {
    background: #dbeafe;
}

.ico-reunion {
    background: #ede9fe;
}

.ico-general {
    background: #f3f4f6;
}

.notif-body {
    flex: 1;
    min-width: 0;
}

.notif-card-titre {
    font-size: 14px;
    font-weight: 600;
    color: #111;
    margin-bottom: 3px;
}

.notif-card-msg {
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 5px;
}

.notif-card-date {
    font-size: 11px;
    color: #9ca3af;
}

.notif-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}

.btn-lire {
    font-size: 11px;
    font-weight: 600;
    color: #006AD7;
    background: none;
    border: 1px solid #006AD7;
    border-radius: 7px;
    padding: 4px 10px;
    cursor: pointer;
    font-family: inherit;
    transition: all .2s;
    white-space: nowrap;
}

.btn-lire:hover {
    background: #006AD7;
    color: #fff;
}

.btn-suppr {
    font-size: 11px;
    font-weight: 600;
    color: #dc2626;
    background: none;
    border: 1px solid #dc2626;
    border-radius: 7px;
    padding: 4px 10px;
    cursor: pointer;
    font-family: inherit;
    transition: all .2s;
    white-space: nowrap;
}

.btn-suppr:hover {
    background: #dc2626;
    color: #fff;
}

.dot-nonlue {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #006AD7;
    flex-shrink: 0;
    margin-top: 6px;
}

/* Empty */
.notif-empty {
    text-align: center;
    padding: 80px 24px;
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e8ecf4;
}

.notif-empty-ico {
    font-size: 52px;
    margin-bottom: 16px;
}

.notif-empty h3 {
    font-size: 18px;
    font-weight: 600;
    color: #111;
    margin-bottom: 8px;
}

.notif-empty p {
    font-size: 13px;
    color: #6b7280;
}

/* Pagination */
.pagination-wrap {
    display: flex;
    justify-content: center;
    gap: 4px;
    margin-top: 20px;
}

.pg-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 30px;
    height: 30px;
    padding: 0 8px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid #e5e7eb;
    color: #6b7280;
    background: #fff;
    transition: all .2s;
}

.pg-btn:hover {
    background: #f0f4ff;
    color: #006AD7;
    border-color: #006AD7;
}

.pg-btn.active {
    background: #006AD7;
    color: #fff;
    border-color: #006AD7;
}

.pg-btn.disabled {
    opacity: .35;
    pointer-events: none;
}
</style>
@endpush

@section('content')
<div class="notif-wrap">

    <div class="notif-header">
        <div>
            <div class="notif-title">🔔 Notifications</div>
            <div class="notif-sub">
                {{ $notifications->total() }} notification(s) —
                {{ $notifications->where('lue', false)->count() }} non lue(s)
            </div>
        </div>
        @if($notifications->where('lue', false)->count() > 0)
        <form method="POST" action="{{
                auth()->user()->isSyndic()
                ? route('syndic.notifications.toutes-lues')
                : route('resident.notifications.toutes-lues')
                }}">
            @csrf
            <button type="submit" class="btn-tout-lire">✓ Tout marquer comme lu</button>
        </form>
        @endif
    </div>

    @if(session('success'))
    <div
        style="background:#f0fdf4;border:1px solid #86efac;color:#15803d;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:13px;">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if($notifications->count())

    @foreach($notifications as $n)
    @php
    $icoClass = match ($n->type) {
    'facture' => 'ico-facture',
    'reclamation' => 'ico-reclamation',
    'annonce' => 'ico-annonce',
    'reunion' => 'ico-reunion',
    default => 'ico-general',
    };
    $icone = match ($n->type) {
    'facture' => '📄',
    'reclamation' => '📢',
    'annonce' => '📣',
    'reunion' => '📅',
    default => '🔔',
    };
    $lueRoute = auth()->user()->isSyndic()
    ? route('syndic.notifications.lue', $n)
    : route('resident.notifications.lue', $n);
    $supprRoute = auth()->user()->isSyndic()
    ? route('syndic.notifications.destroy', $n)
    : route('resident.notifications.destroy', $n);
    @endphp

    <div class="notif-card {{ !$n->lue ? 'non-lue' : '' }}">

        {{-- Point bleu si non lue --}}
        @if(!$n->lue)
        <div class="dot-nonlue"></div>
        @endif

        {{-- Icône --}}
        <div class="notif-ico {{ $icoClass }}">{{ $icone }}</div>

        {{-- Contenu --}}
        <div class="notif-body">
            <div class="notif-card-titre">{{ $n->titre }}</div>
            <div class="notif-card-msg">{{ $n->message }}</div>
            <div class="notif-card-date">{{ $n->created_at->diffForHumans() }} —
                {{ $n->created_at->format('d/m/Y à H:i') }}</div>
        </div>

        {{-- Actions --}}
        <div class="notif-actions">
            @if(!$n->lue)
            <form method="POST" action="{{ $lueRoute }}">
                @csrf
                <button type="submit" class="btn-lire">✓ Lu</button>
            </form>
            @endif
            <form method="POST" action="{{ $supprRoute }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-suppr"
                    onclick="return confirm('Supprimer cette notification ?')">🗑</button>
            </form>
        </div>
    </div>
    @endforeach

    {{-- Pagination --}}
    @if($notifications->hasPages())
    <div class="pagination-wrap">
        @if($notifications->onFirstPage())
        <span class="pg-btn disabled">‹</span>
        @else
        <a href="{{ $notifications->previousPageUrl() }}" class="pg-btn">‹</a>
        @endif

        @foreach(range(1, $notifications->lastPage()) as $p)
        @if($p == $notifications->currentPage())
        <span class="pg-btn active">{{ $p }}</span>
        @else
        <a href="{{ $notifications->url($p) }}" class="pg-btn">{{ $p }}</a>
        @endif
        @endforeach

        @if($notifications->hasMorePages())
        <a href="{{ $notifications->nextPageUrl() }}" class="pg-btn">›</a>
        @else
        <span class="pg-btn disabled">›</span>
        @endif
    </div>
    @endif

    @else
    <div class="notif-empty">
        <div class="notif-empty-ico">🔔</div>
        <h3>Aucune notification</h3>
        <p>Vous n'avez aucune notification pour le moment.</p>
    </div>
    @endif

</div>
@endsection