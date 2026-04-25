<section class="schedule-section" id="jadwal">
    <div class="container">

        <div class="schedule-header reveal">
            <div>
                <p class="section-eyebrow">Jadwal Minggu Ini</p>
                <h2 class="section-title">Siap Berkeringat?</h2>
            </div>
            <a href="{{ route('schedule.index') }}" class="view-all">
                Lihat Semua Jadwal
                <span class="material-symbols-outlined">arrow_right_alt</span>
            </a>
        </div>

        <div class="events-grid">

            {{-- Event 1 --}}
            <article class="event-card reveal">
                <div class="event-thumb">
                    <div class="event-thumb-bg"
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAxmx7mJOURgB9YHz8Rv7hedATPVxYswq3QEBJrkLOPSyafuJC_9ITW4WrMfIaw22Tgs5vTjwExzhrpdaI4iBPmDTi9tF3hDra5sbO69aTo-bxKniQhFixm9XOHHqOHuuMK_IHx0aupWkOPgMbBGZE5I3T-xxZQV_TBVjebAI_HPK06PptLgqfuekDIybefYvtWTwM4TlQnqM_i4Y3yZd62FXHzxQRCVzimh7N6nQ04mNsBB91NpGdGr0uFA35siZe87qtuKuwnEA')"
                        role="img" aria-label="Futsal Santai Malam"></div>
                    <span class="event-badge badge-futsal">Futsal</span>
                </div>
                <div class="event-body">
                    <div class="event-date">
                        <span class="material-symbols-outlined">calendar_today</span>
                        Jumat, 20 Okt 2024
                    </div>
                    <h3 class="event-title">Futsal Santai Malam</h3>
                    <p class="event-location">
                        <span class="material-symbols-outlined">location_on</span>
                        Court A, Jakarta Selatan
                    </p>
                    <div class="event-footer">
                        <span class="event-time">20:00 – 22:00 WIB</span>
                        <a href="{{ route('schedule.show', 1) }}" class="btn btn-primary btn-sm">Daftar</a>
                    </div>
                </div>
            </article>

            {{-- Event 2 --}}
            <article class="event-card reveal animate-delay-1">
                <div class="event-thumb">
                    <div class="event-thumb-bg"
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBCQW5KBoXfGdzjTUGfMxVRK6N3zUn4hkPPSAQGoThWRIEtljZn56oAQxGY_AkOOinFH7dCShr2Xijpfz_QTGXJBf9MoA4lXQtZcMbGpcdM0dkr5bn6B1TSKRE0YOjgzud03zgPGNRpkGcSQleclchb2APobPZQxDbkwg3522_TQiuzZAmsgviEaF1n7PyHfKTlB-NNerlbfE3YS9DQz8fr-j-A9p8svAGHlsFNlA5IbOqIW_sIbEolXlwzuoDNVsX5rREPWmIwqA')"
                        role="img" aria-label="Mini Soccer Weekend"></div>
                    <span class="event-badge badge-minisoccer">Mini Soccer</span>
                </div>
                <div class="event-body">
                    <div class="event-date">
                        <span class="material-symbols-outlined">calendar_today</span>
                        Sabtu, 21 Okt 2024
                    </div>
                    <h3 class="event-title">Mini Soccer Weekend</h3>
                    <p class="event-location">
                        <span class="material-symbols-outlined">location_on</span>
                        Pitch B, Serpong
                    </p>
                    <div class="event-footer">
                        <span class="event-time">16:00 – 18:00 WIB</span>
                        <a href="{{ route('schedule.show', 2) }}" class="btn btn-primary btn-sm">Daftar</a>
                    </div>
                </div>
            </article>

            {{-- Event 3 --}}
            <article class="event-card reveal animate-delay-2">
                <div class="event-thumb">
                    <div class="event-thumb-bg"
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC8Ees-vqdP1Yj30sqYmSoKX3morYuchlT6syTDyhYlvu95tx5w0baq3dnc-_Nh-bltMvjhoWxvQcdbDpVg2py15S9e6fhjsgRaIS4DF6jqC1CsxIUT5L4gvnIpTewnu8IfqSvJNCApGlNUSUpSC4tB6Qi2Z_r0vnvYyiBXrq-b10zBX73mNf_f12eoIad5on7rf8eYlFF1qs1MNZh8egdlq2D_vsEiAySwH8t1Fn_w5zPoeDmCg4VCaBe6NZ2Os2EFD9Y8EepXlg')"
                        role="img" aria-label="Sunday Morning Run"></div>
                    <span class="event-badge badge-lari">Lari Pagi</span>
                </div>
                <div class="event-body">
                    <div class="event-date">
                        <span class="material-symbols-outlined">calendar_today</span>
                        Ahad, 22 Okt 2024
                    </div>
                    <h3 class="event-title">Sunday Morning Run</h3>
                    <p class="event-location">
                        <span class="material-symbols-outlined">location_on</span>
                        GBK Senayan, Jakarta
                    </p>
                    <div class="event-footer">
                        <span class="event-time">06:00 – 08:00 WIB</span>
                        <a href="{{ route('schedule.show', 3) }}" class="btn btn-primary btn-sm">Daftar</a>
                    </div>
                </div>
            </article>

        </div>
    </div>
</section>
