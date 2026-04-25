@extends('layouts.app')
@section('title', 'Pilih Tim — ' . $event['title'] . ' — MBG FC')

@section('content')

    <div class="page-banner">
        <div class="page-banner-inner">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="material-symbols-outlined" style="font-size:1rem">chevron_right</span>
                <a href="{{ route('schedule.index') }}">Jadwal</a>
                <span class="material-symbols-outlined" style="font-size:1rem">chevron_right</span>
                <a href="{{ route('schedule.show', $event['id']) }}">{{ $event['title'] }}</a>
                <span class="material-symbols-outlined" style="font-size:1rem">chevron_right</span>
                <span>Pilih Tim</span>
            </nav>
            {{-- <span class="event-badge badge-{{ $event['type_slug'] }}" style="margin-bottom:1rem;display:inline-block">
                {{ $event['type'] }}
            </span> --}}
            <h1 class="section-title">{{ $event['title'] }}</h1>
        </div>
    </div>

    @if (session('error'))
        <div class="flash flash-error">
            <span class="material-symbols-outlined">error</span>
            {{ session('error') }}
        </div>
    @endif

    <section class="show-section">
        <div class="show-container">

            {{-- Step Indicator --}}
            @include('schedule.steps', ['current' => 2])

            {{-- Header --}}
            <div class="panel-header">
                <a href="{{ route('schedule.show', $event['id']) }}" class="panel-back" aria-label="Kembali">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div>
                    <p class="section-eyebrow" style="margin-bottom:.1rem">Langkah 2 dari 3</p>
                    <h2 class="panel-title">Pilih Tim Kamu</h2>
                </div>
            </div>
            <p class="panel-desc">
                Setiap tim terdiri dari maksimal <strong>{{ $event['max_member_per_team'] }} pemain</strong>.
                Pilih tim yang masih ada kuotanya dan lihat siapa saja yang sudah bergabung.
            </p>

            {{-- Team Cards --}}
            <div class="teams-grid">
                @foreach ($teams as $team)
                    @php
                        $isFull = $team['current_member'] >= $team['max_member'];
                        $pct =
                            $team['max_member'] > 0
                                ? min(100, round(($team['current_member'] / $team['max_member']) * 100))
                                : 0;
                        $barColor = $isFull ? '#ef4444' : $team['color'];
                        $sisa = $team['max_member'] - $team['current_member'];
                    @endphp

                    <div class="team-card {{ $isFull ? 'team-card--full' : '' }}">

                        {{-- Header --}}
                        <div class="team-card-header" style="background:{{ $team['gradient'] }}">
                            <div class="team-emblem">{{ $team['emoji'] }}</div>
                            <div class="team-header-info">
                                <h3 class="team-name">Tim {{ $team['name'] }}</h3>
                                <div class="team-quota-badge">
                                    <span class="material-symbols-outlined" style="font-size:.9rem">person</span>
                                    {{ $team['current_member'] }} / {{ $team['max_member'] }} pemain
                                </div>
                            </div>
                            <div class="team-status {{ $isFull ? 'full' : 'available' }}">
                                <span class="material-symbols-outlined">{{ $isFull ? 'block' : 'check_circle' }}</span>
                                {{ $isFull ? 'Penuh' : 'Tersedia' }}
                            </div>
                        </div>

                        {{-- Body --}}
                        <div class="team-card-body">

                            {{-- Quota bar --}}
                            <div class="team-quota-bar-wrap">
                                <div class="quota-track" style="flex:1">
                                    <div class="quota-fill"
                                        style="width:{{ $pct }}%;background:{{ $barColor }}"></div>
                                </div>
                                <span class="quota-label" style="{{ $isFull ? 'color:#ef4444;font-weight:700' : '' }}">
                                    {{ $isFull ? 'Kuota penuh' : 'Sisa ' . $sisa . ' tempat' }}
                                </span>
                            </div>

                            {{-- Daftar anggota --}}
                            <div class="member-list-wrap">
                                <p class="member-list-title">
                                    <span class="material-symbols-outlined">groups</span>
                                    Pemain terdaftar:
                                </p>
                                <div class="member-list">
                                    @forelse ($team['members'] as $member)
                                        <span class="member-chip">{{ $member }}</span>
                                    @empty
                                        <span style="font-size:.82rem;color:var(--color-muted);font-style:italic">
                                            Belum ada anggota
                                        </span>
                                    @endforelse
                                </div>
                            </div>

                        </div>

                        {{-- Footer — tombol daftar / link ke form --}}
                        <div class="team-card-footer">
                            @if ($isFull)
                                <button class="btn-team" disabled style="--tc:#94a3b8;opacity:.45;cursor:not-allowed">
                                    <span class="material-symbols-outlined">block</span>
                                    Tim Penuh
                                </button>
                            @else
                                <a href="{{ route('schedule.register.form', [$event['id'], $team['id']]) }}"
                                    class="btn-team" style="--tc:{{ $team['color'] }}">
                                    <span class="material-symbols-outlined">how_to_reg</span>
                                    Daftar ke Tim Ini
                                </a>
                            @endif
                        </div>

                    </div>{{-- /team-card --}}
                @endforeach
            </div>{{-- /teams-grid --}}

        </div>
    </section>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
@endpush
