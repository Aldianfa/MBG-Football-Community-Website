@extends('layouts.app')
@section('title', 'Jadwal Kegiatan — MBG FC')

@section('content')

    {{-- Banner --}}
    <div class="page-banner">
        <div class="page-banner-inner">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="material-symbols-outlined" style="font-size:1rem">chevron_right</span>
                <span>Jadwal</span>
            </nav>
            <p class="section-eyebrow">Kegiatan Rutin</p>
            <h1 class="section-title">Jadwal Lengkap</h1>
            <p class="section-desc" style="max-width:36rem;margin-inline:auto">
                Semua jadwal kegiatan olahraga MBG FC dalam satu tempat.
                Pilih yang sesuai waktu &amp; minatmu.
            </p>
        </div>
    </div>

    {{-- Flash message --}}
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

    <section style="padding:3rem 1.5rem 5rem">
        <div class="container">
            <div class="events-grid">
                @foreach ($events as $event)
                    @php
                        $isFull =
                            $event['quota_total'] > 0 &&
                            $event['quota_total'] <= array_sum(array_column([], 'current_member'));
                        $isFree = $event['price'] === 0;
                    @endphp

                    <article class="event-card">
                        <div class="event-thumb">
                            <div class="event-thumb-bg" style="background-image:url('{{ $event['thumb_image'] }}')"
                                role="img" aria-label="{{ $event['title'] }}"></div>
                            <span class="event-badge badge-{{ $event['type_slug'] }}">{{ $event['type'] }}</span>
                            @if ($isFree)
                                <span class="event-badge" style="top:auto;bottom:.75rem;background:#1B5E20">Gratis</span>
                            @endif
                        </div>
                        <div class="event-body">
                            <div class="event-date">
                                <span class="material-symbols-outlined">calendar_today</span>
                                {{ \Carbon\Carbon::parse($event['date'])->isoFormat('dddd, D MMM YYYY') }}
                            </div>
                            <h3 class="event-title">{{ $event['title'] }}</h3>
                            <p class="event-location">
                                <span class="material-symbols-outlined">location_on</span>
                                {{ $event['location'] }}
                            </p>
                            <div class="event-footer">
                                <span class="event-time">{{ $event['time_start'] }} – {{ $event['time_end'] }} WIB</span>
                                <a href="{{ route('schedule.show', $event['id']) }}" class="btn btn-primary btn-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

@endsection
