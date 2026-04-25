{{--
    Partial: Step Indicator
    Variabel: $current (int) — step aktif: 1, 2, atau 3
--}}
@php
    $steps = [
        1 => ['label' => 'Detail Event', 'icon' => 'info'],
        2 => ['label' => 'Pilih Tim', 'icon' => 'group'],
        3 => ['label' => 'Daftar', 'icon' => 'how_to_reg'],
    ];
@endphp

<div class="step-indicator">
    @foreach ($steps as $n => $step)
        <div class="step {{ $n === $current ? 'active' : ($n < $current ? 'done' : '') }}">
            <div class="step-circle">
                @if ($n < $current)
                    <span class="material-symbols-outlined">check</span>
                @else
                    <span class="material-symbols-outlined">{{ $step['icon'] }}</span>
                @endif
            </div>
            <span class="step-label">{{ $step['label'] }}</span>
        </div>

        @if (!$loop->last)
            <div class="step-line {{ $n < $current ? 'done' : '' }}"></div>
        @endif
    @endforeach
</div>
