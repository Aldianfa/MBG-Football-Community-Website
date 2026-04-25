@extends('layouts.app')
@section('title', $event['title'] . ' — MBG FC')

@section('content')

    {{-- Banner --}}
    <div class="page-banner">
        <div class="page-banner-inner">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="material-symbols-outlined" style="font-size:1rem">chevron_right</span>
                <a href="{{ route('schedule.index') }}">Jadwal</a>
                <span class="material-symbols-outlined" style="font-size:1rem">chevron_right</span>
                <span>{{ $event['title'] }}</span>
            </nav>
            {{-- <span class="event-badge badge-{{ $event['type_slug'] }}" style="margin-bottom:1rem;display:inline-block">
                {{ $event['type'] }}
            </span> --}}
            <h1 class="section-title">{{ $event['title'] }}</h1>
        </div>
    </div>

    {{-- Flash --}}
    @if (session('success'))
        <div class="flash flash-success">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="flash flash-error">
            <span class="material-symbols-outlined">error</span>
            {{ session('error') }}
        </div>
    @endif

    <section class="show-section">
        <div class="show-container">

            {{-- Step Indicator --}}
            @include('schedule.steps', ['current' => 1])

            {{-- Detail Card --}}
            <div class="detail-card">

                {{-- Thumbnail --}}
                <div class="detail-thumb">
                    <img src="{{ $event['thumb_image'] }}" alt="{{ $event['title'] }}">
                </div>

                <div class="detail-body">

                    {{-- Meta chips --}}
                    <div class="detail-meta">
                        <div class="meta-chip">
                            <span class="material-symbols-outlined">calendar_today</span>
                            {{ \Carbon\Carbon::parse($event['date'])->isoFormat('dddd, D MMMM YYYY') }}
                        </div>
                        <div class="meta-chip">
                            <span class="material-symbols-outlined">schedule</span>
                            {{ $event['time_start'] }} – {{ $event['time_end'] }} WIB
                        </div>
                        <div class="meta-chip">
                            <span class="material-symbols-outlined">location_on</span>
                            @if ($event['location_maps_url'])
                                <a href="{{ $event['location_maps_url'] }}" target="_blank" rel="noopener"
                                    style="color:var(--color-primary);font-weight:600">
                                    {{ $event['location'] }}
                                </a>
                            @else
                                {{ $event['location'] }}
                            @endif
                        </div>
                        <div class="meta-chip">
                            <span class="material-symbols-outlined">payments</span>
                            {{ $event['price'] > 0 ? 'Rp ' . number_format($event['price'], 0, ',', '.') . ' / orang' : 'Gratis' }}
                        </div>
                    </div>

                    {{-- Quota bar — hanya tampil jika quota_total > 0 --}}
                    @if ($event['quota_total'] > 0)
                        @php
                            $pct = min(100, round(($totalRegistered / $event['quota_total']) * 100));
                            $barColor = $pct >= 100 ? '#ef4444' : 'var(--color-primary)';
                        @endphp
                        <div class="detail-quota-wrap">
                            <div class="detail-quota-header">
                                <span>Total kuota keseluruhan</span>
                                <strong>{{ $totalRegistered }} / {{ $event['quota_total'] }} peserta</strong>
                            </div>
                            <div class="quota-track">
                                <div class="quota-fill" style="width:{{ $pct }}%;background:{{ $barColor }}">
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Deskripsi --}}
                    <div class="detail-desc">
                        @foreach (explode("\n\n", $event['description']) as $para)
                            <p>{{ $para }}</p>
                        @endforeach
                    </div>

                    {{-- Tim ringkasan --}}
                    @if (count($teams) > 0)
                        <div class="teams-mini-wrap">
                            <p class="teams-mini-label">Tim yang tersedia:</p>
                            <div class="teams-mini-row">
                                @foreach ($teams as $team)
                                    @php $isFull = $team['current_member'] >= $team['max_member']; @endphp
                                    <div class="team-mini-chip"
                                        style="border-color:{{ $isFull ? '#ef4444' : $team['color'] }}">
                                        <span>{{ $team['emoji'] }} {{ $team['name'] }}</span>
                                        <span
                                            style="font-size:.72rem;color:{{ $isFull ? '#ef4444' : 'var(--color-muted)' }};font-weight:600">
                                            {{ $isFull ? 'Penuh' : $team['max_member'] - $team['current_member'] . ' sisa' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- CTA --}}
                    <a href="{{ route('schedule.teams', $event['id']) }}" class="btn btn-primary" style="width:100%">
                        <span class="material-symbols-outlined">group</span>
                        Pilih Tim &amp; Daftar
                    </a>

                </div>{{-- /detail-body --}}
            </div>{{-- /detail-card --}}

            <a href="{{ route('schedule.index') }}" class="back-link">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Jadwal
            </a>

        </div>
    </section>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
@endpush
