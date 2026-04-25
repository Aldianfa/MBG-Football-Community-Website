@extends('layouts.app')
@section('title', 'Galeri — MBG FC')

@section('content')

    <div class="page-banner">
        <div class="page-banner-inner">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="material-symbols-outlined" style="font-size:1rem">chevron_right</span>
                <span>Galeri</span>
            </nav>
            <p class="section-eyebrow">Momen Berkesan</p>
            <h1 class="section-title">Galeri Foto</h1>
            <p class="section-desc" style="max-width:36rem;margin-inline:auto">
                Rekam jejak kebersamaan, keringat, dan tawa anggota MBG FC dalam setiap kegiatan.
            </p>
        </div>
    </div>

    <section class="gallery-section" style="padding-top:3rem">
        <div class="container">

            {{-- Filter Tabs --}}
            <div class="filter-tabs" role="tablist">
                <button class="filter-tab active" data-filter="all">Semua</button>
                <button class="filter-tab" data-filter="futsal">Futsal</button>
                <button class="filter-tab" data-filter="minisoccer">Mini Soccer</button>
                <button class="filter-tab" data-filter="lari">Lari Pagi</button>
                <button class="filter-tab" data-filter="badminton">Badminton</button>
                <button class="filter-tab" data-filter="event">Event Khusus</button>
            </div>

            {{-- Photo Grid --}}
            <div class="gallery-grid" id="gallery-grid">

                {{-- 1 — featured/wide --}}
                <div class="gallery-item wide" data-category="futsal"
                    data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxmx7mJOURgB9YHz8Rv7hedATPVxYswq3QEBJrkLOPSyafuJC_9ITW4WrMfIaw22Tgs5vTjwExzhrpdaI4iBPmDTi9tF3hDra5sbO69aTo-bxKniQhFixm9XOHHqOHuuMK_IHx0aupWkOPgMbBGZE5I3T-xxZQV_TBVjebAI_HPK06PptLgqfuekDIybefYvtWTwM4TlQnqM_i4Y3yZd62FXHzxQRCVzimh7N6nQ04mNsBB91NpGdGr0uFA35siZe87qtuKuwnEA"
                    data-caption="Sesi futsal malam — Court A, Jaksel" tabindex="0" role="button"
                    aria-label="Lihat foto: Sesi futsal malam">
                    <img class="gallery-img"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxmx7mJOURgB9YHz8Rv7hedATPVxYswq3QEBJrkLOPSyafuJC_9ITW4WrMfIaw22Tgs5vTjwExzhrpdaI4iBPmDTi9tF3hDra5sbO69aTo-bxKniQhFixm9XOHHqOHuuMK_IHx0aupWkOPgMbBGZE5I3T-xxZQV_TBVjebAI_HPK06PptLgqfuekDIybefYvtWTwM4TlQnqM_i4Y3yZd62FXHzxQRCVzimh7N6nQ04mNsBB91NpGdGr0uFA35siZe87qtuKuwnEA"
                        alt="Sesi futsal malam">
                    <div class="gallery-overlay">
                        <p class="gallery-caption">
                            <span class="material-symbols-outlined"
                                style="font-size:1rem;vertical-align:middle">zoom_in</span>
                            Sesi futsal malam — Court A, Jaksel
                        </p>
                    </div>
                </div>

                {{-- 2 --}}
                <div class="gallery-item" data-category="minisoccer"
                    data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCQW5KBoXfGdzjTUGfMxVRK6N3zUn4hkPPSAQGoThWRIEtljZn56oAQxGY_AkOOinFH7dCShr2Xijpfz_QTGXJBf9MoA4lXQtZcMbGpcdM0dkr5bn6B1TSKRE0YOjgzud03zgPGNRpkGcSQleclchb2APobPZQxDbkwg3522_TQiuzZAmsgviEaF1n7PyHfKTlB-NNerlbfE3YS9DQz8fr-j-A9p8svAGHlsFNlA5IbOqIW_sIbEolXlwzuoDNVsX5rREPWmIwqA"
                    data-caption="Mini Soccer Weekend — Pitch B, Serpong" tabindex="0" role="button"
                    aria-label="Lihat foto: Mini Soccer Weekend">
                    <img class="gallery-img"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCQW5KBoXfGdzjTUGfMxVRK6N3zUn4hkPPSAQGoThWRIEtljZn56oAQxGY_AkOOinFH7dCShr2Xijpfz_QTGXJBf9MoA4lXQtZcMbGpcdM0dkr5bn6B1TSKRE0YOjgzud03zgPGNRpkGcSQleclchb2APobPZQxDbkwg3522_TQiuzZAmsgviEaF1n7PyHfKTlB-NNerlbfE3YS9DQz8fr-j-A9p8svAGHlsFNlA5IbOqIW_sIbEolXlwzuoDNVsX5rREPWmIwqA"
                        alt="Mini Soccer Weekend" loading="lazy">
                    <div class="gallery-overlay">
                        <p class="gallery-caption">
                            <span class="material-symbols-outlined"
                                style="font-size:1rem;vertical-align:middle">zoom_in</span>
                            Mini Soccer Weekend
                        </p>
                    </div>
                </div>

                {{-- 3 --}}
                <div class="gallery-item" data-category="lari"
                    data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuC8Ees-vqdP1Yj30sqYmSoKX3morYuchlT6syTDyhYlvu95tx5w0baq3dnc-_Nh-bltMvjhoWxvQcdbDpVg2py15S9e6fhjsgRaIS4DF6jqC1CsxIUT5L4gvnIpTewnu8IfqSvJNCApGlNUSUpSC4tB6Qi2Z_r0vnvYyiBXrq-b10zBX73mNf_f12eoIad5on7rf8eYlFF1qs1MNZh8egdlq2D_vsEiAySwH8t1Fn_w5zPoeDmCg4VCaBe6NZ2Os2EFD9Y8EepXlg"
                    data-caption="Sunday Morning Run — GBK Senayan" tabindex="0" role="button"
                    aria-label="Lihat foto: Sunday Morning Run">
                    <img class="gallery-img"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuC8Ees-vqdP1Yj30sqYmSoKX3morYuchlT6syTDyhYlvu95tx5w0baq3dnc-_Nh-bltMvjhoWxvQcdbDpVg2py15S9e6fhjsgRaIS4DF6jqC1CsxIUT5L4gvnIpTewnu8IfqSvJNCApGlNUSUpSC4tB6Qi2Z_r0vnvYyiBXrq-b10zBX73mNf_f12eoIad5on7rf8eYlFF1qs1MNZh8egdlq2D_vsEiAySwH8t1Fn_w5zPoeDmCg4VCaBe6NZ2Os2EFD9Y8EepXlg"
                        alt="Sunday Morning Run" loading="lazy">
                    <div class="gallery-overlay">
                        <p class="gallery-caption">
                            <span class="material-symbols-outlined"
                                style="font-size:1rem;vertical-align:middle">zoom_in</span>
                            Sunday Morning Run
                        </p>
                    </div>
                </div>

                {{-- 4 — wide --}}
                <div class="gallery-item wide" data-category="event"
                    data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuCrbXdJ2PaWXtD5I5ENt1KENzVqMnk4BpGfgEC4Jumam53dMP4Rwfzd5fdVkGUHCOVqchHKAIwutCRxyC30u3rkyWA_KAwyWn-J8oDy_H-Lx-EYs9Oz4QVtn0y5tIluhLx47PM_CjYVrohfOxX_QqfidTztvbsFQzYGxDDga_0l2BMldDxDNErHXYq69VGnNd4PYsN_ApiUG1q8C3dHd5ho4RAKrBF77x4794KqB98rAsEMd6FCA5zyxUWa3HhF14NNsZTrOqtAQQ"
                    data-caption="Tournament MBG FC 2024 — Lapangan Utama" tabindex="0" role="button"
                    aria-label="Lihat foto: Tournament MBG FC">
                    <img class="gallery-img"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCrbXdJ2PaWXtD5I5ENt1KENzVqMnk4BpGfgEC4Jumam53dMP4Rwfzd5fdVkGUHCOVqchHKAIwutCRxyC30u3rkyWA_KAwyWn-J8oDy_H-Lx-EYs9Oz4QVtn0y5tIluhLx47PM_CjYVrohfOxX_QqfidTztvbsFQzYGxDDga_0l2BMldDxDNErHXYq69VGnNd4PYsN_ApiUG1q8C3dHd5ho4RAKrBF77x4794KqB98rAsEMd6FCA5zyxUWa3HhF14NNsZTrOqtAQQ"
                        alt="Tournament MBG FC 2024" loading="lazy">
                    <div class="gallery-overlay">
                        <p class="gallery-caption">
                            <span class="material-symbols-outlined"
                                style="font-size:1rem;vertical-align:middle">zoom_in</span>
                            Tournament MBG FC 2024
                        </p>
                    </div>
                </div>

                {{-- 5 --}}
                <div class="gallery-item" data-category="badminton"
                    data-src="https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?w=1200&q=80"
                    data-caption="Badminton Bersama — GOR Palmerah" tabindex="0" role="button"
                    aria-label="Lihat foto: Badminton Bersama">
                    <img class="gallery-img" src="https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?w=600&q=80"
                        alt="Badminton Bersama" loading="lazy">
                    <div class="gallery-overlay">
                        <p class="gallery-caption">
                            <span class="material-symbols-outlined"
                                style="font-size:1rem;vertical-align:middle">zoom_in</span>
                            Badminton Bersama
                        </p>
                    </div>
                </div>

                {{-- 6 --}}
                <div class="gallery-item" data-category="futsal"
                    data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxmx7mJOURgB9YHz8Rv7hedATPVxYswq3QEBJrkLOPSyafuJC_9ITW4WrMfIaw22Tgs5vTjwExzhrpdaI4iBPmDTi9tF3hDra5sbO69aTo-bxKniQhFixm9XOHHqOHuuMK_IHx0aupWkOPgMbBGZE5I3T-xxZQV_TBVjebAI_HPK06PptLgqfuekDIybefYvtWTwM4TlQnqM_i4Y3yZd62FXHzxQRCVzimh7N6nQ04mNsBB91NpGdGr0uFA35siZe87qtuKuwnEA"
                    data-caption="Futsal Rabu Sore — Tangsel" tabindex="0" role="button"
                    aria-label="Lihat foto: Futsal Rabu Sore">
                    <img class="gallery-img"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxmx7mJOURgB9YHz8Rv7hedATPVxYswq3QEBJrkLOPSyafuJC_9ITW4WrMfIaw22Tgs5vTjwExzhrpdaI4iBPmDTi9tF3hDra5sbO69aTo-bxKniQhFixm9XOHHqOHuuMK_IHx0aupWkOPgMbBGZE5I3T-xxZQV_TBVjebAI_HPK06PptLgqfuekDIybefYvtWTwM4TlQnqM_i4Y3yZd62FXHzxQRCVzimh7N6nQ04mNsBB91NpGdGr0uFA35siZe87qtuKuwnEA"
                        alt="Futsal Rabu Sore" loading="lazy">
                    <div class="gallery-overlay">
                        <p class="gallery-caption">
                            <span class="material-symbols-outlined"
                                style="font-size:1rem;vertical-align:middle">zoom_in</span>
                            Futsal Rabu Sore
                        </p>
                    </div>
                </div>

                {{-- 7 --}}
                <div class="gallery-item" data-category="lari"
                    data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuC8Ees-vqdP1Yj30sqYmSoKX3morYuchlT6syTDyhYlvu95tx5w0baq3dnc-_Nh-bltMvjhoWxvQcdbDpVg2py15S9e6fhjsgRaIS4DF6jqC1CsxIUT5L4gvnIpTewnu8IfqSvJNCApGlNUSUpSC4tB6Qi2Z_r0vnvYyiBXrq-b10zBX73mNf_f12eoIad5on7rf8eYlFF1qs1MNZh8egdlq2D_vsEiAySwH8t1Fn_w5zPoeDmCg4VCaBe6NZ2Os2EFD9Y8EepXlg"
                    data-caption="Lari Pagi Ahad — GBK Senayan" tabindex="0" role="button"
                    aria-label="Lihat foto: Lari Pagi Ahad">
                    <img class="gallery-img"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuC8Ees-vqdP1Yj30sqYmSoKX3morYuchlT6syTDyhYlvu95tx5w0baq3dnc-_Nh-bltMvjhoWxvQcdbDpVg2py15S9e6fhjsgRaIS4DF6jqC1CsxIUT5L4gvnIpTewnu8IfqSvJNCApGlNUSUpSC4tB6Qi2Z_r0vnvYyiBXrq-b10zBX73mNf_f12eoIad5on7rf8eYlFF1qs1MNZh8egdlq2D_vsEiAySwH8t1Fn_w5zPoeDmCg4VCaBe6NZ2Os2EFD9Y8EepXlg"
                        alt="Lari Pagi Ahad" loading="lazy">
                    <div class="gallery-overlay">
                        <p class="gallery-caption">
                            <span class="material-symbols-outlined"
                                style="font-size:1rem;vertical-align:middle">zoom_in</span>
                            Lari Pagi Ahad
                        </p>
                    </div>
                </div>

                {{-- 8 --}}
                <div class="gallery-item" data-category="event"
                    data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuCrbXdJ2PaWXtD5I5ENt1KENzVqMnk4BpGfgEC4Jumam53dMP4Rwfzd5fdVkGUHCOVqchHKAIwutCRxyC30u3rkyWA_KAwyWn-J8oDy_H-Lx-EYs9Oz4QVtn0y5tIluhLx47PM_CjYVrohfOxX_QqfidTztvbsFQzYGxDDga_0l2BMldDxDNErHXYq69VGnNd4PYsN_ApiUG1q8C3dHd5ho4RAKrBF77x4794KqB98rAsEMd6FCA5zyxUWa3HhF14NNsZTrOqtAQQ"
                    data-caption="Gathering Tahunan MBG FC" tabindex="0" role="button"
                    aria-label="Lihat foto: Gathering Tahunan">
                    <img class="gallery-img"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCrbXdJ2PaWXtD5I5ENt1KENzVqMnk4BpGfgEC4Jumam53dMP4Rwfzd5fdVkGUHCOVqchHKAIwutCRxyC30u3rkyWA_KAwyWn-J8oDy_H-Lx-EYs9Oz4QVtn0y5tIluhLx47PM_CjYVrohfOxX_QqfidTztvbsFQzYGxDDga_0l2BMldDxDNErHXYq69VGnNd4PYsN_ApiUG1q8C3dHd5ho4RAKrBF77x4794KqB98rAsEMd6FCA5zyxUWa3HhF14NNsZTrOqtAQQ"
                        alt="Gathering Tahunan MBG FC" loading="lazy">
                    <div class="gallery-overlay">
                        <p class="gallery-caption">
                            <span class="material-symbols-outlined"
                                style="font-size:1rem;vertical-align:middle">zoom_in</span>
                            Gathering Tahunan MBG FC
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        (function() {
            // Category filter
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    const f = tab.dataset.filter;
                    document.querySelectorAll('.gallery-item[data-category]').forEach(item => {
                        item.style.display = (f === 'all' || item.dataset.category === f) ? '' :
                            'none';
                    });
                });
            });

            // Keyboard trigger for gallery items
            document.querySelectorAll('.gallery-item[data-src]').forEach(item => {
                item.addEventListener('keydown', e => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        item.click();
                    }
                });
            });
        })();
    </script>
@endpush
