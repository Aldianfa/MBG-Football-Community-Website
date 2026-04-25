@extends('layouts.app')
@section('title', 'Daftar — Tim ' . $team['name'] . ' — MBG FC')

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
                <a href="{{ route('schedule.teams', $event['id']) }}">Pilih Tim</a>
                <span class="material-symbols-outlined" style="font-size:1rem">chevron_right</span>
                <span>Daftar</span>
            </nav>
            {{-- <span class="event-badge badge-{{ $event['type_slug'] }}" style="margin-bottom:1rem;display:inline-block">
                {{ $event['type'] }}
            </span> --}}
            <h1 class="section-title">{{ $event['title'] }}</h1>
        </div>
    </div>

    <section class="show-section">
        <div class="show-container">

            {{-- Step Indicator --}}
            @include('schedule.steps', ['current' => 3])

            {{-- Header --}}
            <div class="panel-header">
                <a href="{{ route('schedule.teams', $event['id']) }}" class="panel-back" aria-label="Kembali pilih tim">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div>
                    <p class="section-eyebrow" style="margin-bottom:.1rem">Langkah 3 dari 3</p>
                    <h2 class="panel-title">Formulir Pendaftaran</h2>
                </div>
            </div>

            {{-- Validasi error --}}
            @if ($errors->any())
                <div class="flash flash-error" style="flex-direction:column;align-items:flex-start;gap:.35rem">
                    <div style="display:flex;align-items:center;gap:.5rem;font-weight:700">
                        <span class="material-symbols-outlined">error</span>
                        Harap perbaiki kesalahan berikut:
                    </div>
                    <ul style="margin:0;padding-left:1.5rem;font-size:.875rem">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Banner tim terpilih --}}
            <div class="selected-team-banner" style="border-color:{{ $team['color'] }}55;background:{{ $team['color'] }}12">
                <span style="font-size:1.5rem">{{ $team['emoji'] }}</span>
                <div>
                    <p style="font-size:.75rem;color:var(--color-muted);margin-bottom:.1rem">Tim yang dipilih</p>
                    <p style="font-weight:800;color:var(--color-text)">Tim {{ $team['name'] }}</p>
                </div>
                <div style="margin-left:auto;text-align:right">
                    <p style="font-size:.75rem;color:var(--color-muted);margin-bottom:.1rem">Sisa kuota</p>
                    <p style="font-weight:800;color:{{ $team['color'] }}">
                        {{ $team['max_member'] - $team['current_member'] }} Orang
                    </p>
                </div>
                <a href="{{ route('schedule.teams', $event['id']) }}" class="change-team-btn">
                    Ganti Tim
                </a>
            </div>

            {{-- ============================================================
             KOTAK INFO PEMBAYARAN
             ============================================================ --}}
            @if ($event['price'] > 0)
                <div class="payment-info-box">
                    <div class="payment-info-header">
                        <span class="material-symbols-outlined">payments</span>
                        Informasi Pembayaran
                    </div>
                    <div class="payment-info-body">

                        <div class="payment-qr-wrap">
                            <div class="qr-box">
                                <a href="{{ asset('images/qr-mbgfc.png') }}" target="_blank">
                                    <img src="{{ asset('images/qr-mbgfc.png') }}" alt="QR Code" class="qr-svg">
                                    <p class="qr-label">Scan untuk bayar</p>
                                </a>
                            </div>

                            {{-- Rekening --}}
                            <div class="payment-rekening">

                                <div class="rekening-item">
                                    <span class="rekening-bank">🏦 Bank BCA</span>
                                    <div class="rekening-number">
                                        <span>1234 5678 90</span>
                                    </div>
                                    <span class="rekening-owner">a.n. MBG Football Community</span>
                                </div>

                                <div class="rekening-divider">atau</div>

                                <div class="rekening-item">
                                    <span class="rekening-bank">📱 GoPay / OVO / Dana</span>
                                    <div class="rekening-number">
                                        <span>0812 3456 7890</span>
                                    </div>
                                    <span class="rekening-owner">a.n. MBG Football Community</span>
                                </div>

                                <div class="payment-amount-box">
                                    <span class="material-symbols-outlined"
                                        style="font-size:2rem;color:var(--color-primary)">payments</span>
                                    <div>
                                        <p style="font-size:.78rem;color:var(--color-muted);margin-bottom:.1rem">Nominal
                                            transfer</p>
                                        <p style="font-size:1.4rem;font-weight:900;color:var(--color-primary-dark)">
                                            Rp {{ number_format($event['price'], 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>{{-- /payment-qr-wrap --}}

                        {{-- Pending notice --}}
                        <div class="pending-notice">
                            <span class="material-symbols-outlined pending-icon">hourglass_top</span>
                            <div>
                                <p class="pending-title">Pendaftaran menunggu persetujuan admin</p>
                                <p class="pending-desc">
                                    Setelah mengirim formulir dan bukti transfer, admin akan memverifikasi
                                    dalam <strong>1×24 jam</strong>. Konfirmasi dikirim via WhatsApp
                                    ke nomor yang kamu daftarkan.
                                </p>
                            </div>
                        </div>

                    </div>{{-- /payment-info-body --}}
                </div>{{-- /payment-info-box --}}
            @endif

            {{-- ============================================================
             FORMULIR PENDAFTARAN
             ============================================================ --}}
            <div class="reg-form-wrap">
                <form action="{{ route('schedule.register.store', $event['id']) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Hidden: team_id dan event context --}}
                    <input type="hidden" name="team_id" value="{{ $team['id'] }}">

                    <div class="form-grid">

                        {{-- Nama Lengkap --}}
                        <div class="form-group">
                            <label for="name" class="form-label">
                                Nama Lengkap <span class="form-required">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="Sesuai KTP" class="form-input @error('name') input-error @enderror" required>
                            @error('name')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nomor WhatsApp --}}
                        <div class="form-group">
                            <label for="no_wa" class="form-label">
                                Nomor WhatsApp <span class="form-required">*</span>
                            </label>
                            <div class="input-prefix-wrap @error('no_wa') input-error-wrap @enderror">
                                <span class="input-prefix">+62</span>
                                <input type="tel" id="no_wa" name="no_wa" value="{{ old('no_wa') }}"
                                    placeholder="812 3456 7890"
                                    class="form-input input-with-prefix @error('no_wa') input-error @enderror" required>
                            </div>
                            @error('no_wa')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Bukti Transfer --}}
                        <div class="form-group" style="grid-column:1/-1">
                            <label for="bukti_tf" class="form-label">
                                Bukti Transfer
                                @if ($event['price'] > 0)
                                    <span class="form-required">*</span>
                                @else
                                    <span style="font-size:.78rem;color:var(--color-muted);font-weight:400">(tidak wajib —
                                        event gratis)</span>
                                @endif
                            </label>
                            <div class="file-upload-area @error('bukti_tf') file-upload-error @enderror">
                                <input type="file" id="bukti_tf" name="bukti_tf"
                                    accept="image/jpeg,image/png,application/pdf"
                                    {{ $event['price'] > 0 ? 'required' : '' }}
                                    style="display:block;width:100%;padding:.5rem 0;color:var(--color-text);font-family:var(--font-display);font-size:.9rem;cursor:pointer">
                                <p style="font-size:.78rem;color:var(--color-muted);margin-top:.35rem">
                                    Format: JPG, PNG, PDF — maksimal 5 MB
                                </p>
                            </div>
                            @error('bukti_tf')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Catatan --}}
                        <div class="form-group" style="grid-column:1/-1">
                            <label for="notes" class="form-label">
                                Catatan <span
                                    style="font-size:.78rem;color:var(--color-muted);font-weight:400">(opsional)</span>
                            </label>
                            <textarea id="notes" name="notes" rows="3"
                                placeholder="Misal: nama di struk berbeda, atau ada pertanyaan lain..."
                                class="form-input form-textarea @error('notes') input-error @enderror">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>{{-- /form-grid --}}

                    <button type="submit" class="btn btn-primary" style="width:100%;margin-top:1.5rem;padding:1.1rem">
                        <span class="material-symbols-outlined">send</span>
                        Kirim Pendaftaran
                    </button>

                    <p class="form-footer-note">
                        <span class="material-symbols-outlined" style="font-size:1rem;vertical-align:middle">lock</span>
                        Data kamu aman dan hanya digunakan untuk keperluan administrasi MBG FC.
                    </p>

                </form>
            </div>{{-- /reg-form-wrap --}}

        </div>
    </section>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
@endpush
