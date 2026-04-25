@extends('layouts.app')
@section('title', 'MBG FC — Muslim Bugar Football Community')

@section('content')
    @include('sections.hero')
    @include('sections.stats')
    @include('sections.about')
    @include('sections.visi-misi')
    @include('sections.schedule-preview')
    @include('sections.cta')
@endsection

@push('styles')
    <style>
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.55s ease, transform 0.55s ease;
        }

        .reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endpush
