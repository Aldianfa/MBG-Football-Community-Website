<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

/**
 * ScheduleController
 *
 * Semua data saat ini di-hardcode di private method getEvents() dan getTeams().
 * Struktur array sudah disesuaikan 1:1 dengan skema tabel yang akan dibuat:
 *
 *   EVENTS        → id, title, description, quota_total, team_limit,
 *                   max_member_per_team, status
 *
 *   TEAMS         → id, event_id, name, max_member, current_member
 *
 *   REGISTRATIONS → id, event_id, team_id, name, no_wa, bukti_tf,
 *                   status, expired_at
 *
 * Cara migrasi ke database nantinya — cukup ganti isi method:
 *   getEvents()         → Event::all()  atau  Event::where('status','active')->get()
 *   findEvent($id)      → Event::findOrFail($id)
 *   getTeams($eventId)  → Team::where('event_id', $eventId)->withCount('registrations')->get()
 *   findTeam(...)       → Team::where('event_id',$eventId)->findOrFail($teamId)
 */

class EventController extends Controller
{
    // =========================================================================
    // DATA HARDCODE — ganti dengan Eloquent query setelah DB siap
    // =========================================================================

    private function getEvents(): array
    {
        return [
            [
                // EVENTS table columns
                'id'                  => 1,
                'title'               => 'Futsal Santai Malam',
                'description'         => "Sesi futsal santai untuk para anggota MBG FC — tidak perlu khawatir soal skill, yang penting semangat dan mau keringetan! Pertandingan dibagi per babak sistem round-robin, setiap orang pasti kebagian main.\n\nBawa perlengkapan: kaos olahraga, celana pendek, dan sepatu futsal. Air minum tersedia di lokasi. Diharapkan datang 15 menit sebelum waktu mulai untuk pemanasan bersama.",
                'quota_total'         => 80,
                'team_limit'          => 4,
                'max_member_per_team' => 20,
                'status'              => 'active',    // active | closed | cancelled

                // Kolom tambahan untuk tampilan (akan masuk tabel events juga)
                'type'                => 'Futsal',
                'type_slug'           => 'futsal',
                'date'                => '2024-10-20',
                'time_start'          => '20:00',
                'time_end'            => '22:00',
                'location'            => 'Court A, Jakarta Selatan',
                'location_maps_url'   => 'https://maps.google.com',
                'price'               => 35000,
                'thumb_image'         => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAxmx7mJOURgB9YHz8Rv7hedATPVxYswq3QEBJrkLOPSyafuJC_9ITW4WrMfIaw22Tgs5vTjwExzhrpdaI4iBPmDTi9tF3hDra5sbO69aTo-bxKniQhFixm9XOHHqOHuuMK_IHx0aupWkOPgMbBGZE5I3T-xxZQV_TBVjebAI_HPK06PptLgqfuekDIybefYvtWTwM4TlQnqM_i4Y3yZd62FXHzxQRCVzimh7N6nQ04mNsBB91NpGdGr0uFA35siZe87qtuKuwnEA',
            ],
            [
                'id'                  => 2,
                'title'               => 'Mini Soccer Weekend',
                'description'         => "Mini Soccer seru akhir pekan bareng anggota MBG FC. Format 7v7, lebih leluasa dari futsal biasa!\n\nSepatu soccer/futsal wajib. Kaos bebas. Lapangan outdoor — siapkan stamina.",
                'quota_total'         => 56,
                'team_limit'          => 4,
                'max_member_per_team' => 14,
                'status'              => 'active',
                'type'                => 'Mini Soccer',
                'type_slug'           => 'minisoccer',
                'date'                => '2024-10-21',
                'time_start'          => '16:00',
                'time_end'            => '18:00',
                'location'            => 'Pitch B, Serpong',
                'location_maps_url'   => null,
                'price'               => 40000,
                'thumb_image'         => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBCQW5KBoXfGdzjTUGfMxVRK6N3zUn4hkPPSAQGoThWRIEtljZn56oAQxGY_AkOOinFH7dCShr2Xijpfz_QTGXJBf9MoA4lXQtZcMbGpcdM0dkr5bn6B1TSKRE0YOjgzud03zgPGNRpkGcSQleclchb2APobPZQxDbkwg3522_TQiuzZAmsgviEaF1n7PyHfKTlB-NNerlbfE3YS9DQz8fr-j-A9p8svAGHlsFNlA5IbOqIW_sIbEolXlwzuoDNVsX5rREPWmIwqA',
            ],
            [
                'id'                  => 3,
                'title'               => 'Sunday Morning Run',
                'description'         => "Lari pagi santai bareng komunitas MBG FC di GBK Senayan. Gratis dan terbuka untuk semua anggota!\n\nRute: putaran dalam GBK, sekitar 3–5 km. Bawa minum sendiri.",
                'quota_total'         => 0,    // 0 = tidak terbatas
                'team_limit'          => 0,
                'max_member_per_team' => 0,
                'status'              => 'active',
                'type'                => 'Lari Pagi',
                'type_slug'           => 'lari',
                'date'                => '2024-10-22',
                'time_start'          => '06:00',
                'time_end'            => '08:00',
                'location'            => 'GBK Senayan, Jakarta',
                'location_maps_url'   => 'https://maps.google.com',
                'price'               => 0,
                'thumb_image'         => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC8Ees-vqdP1Yj30sqYmSoKX3morYuchlT6syTDyhYlvu95tx5w0baq3dnc-_Nh-bltMvjhoWxvQcdbDpVg2py15S9e6fhjsgRaIS4DF6jqC1CsxIUT5L4gvnIpTewnu8IfqSvJNCApGlNUSUpSC4tB6Qi2Z_r0vnvYyiBXrq-b10zBX73mNf_f12eoIad5on7rf8eYlFF1qs1MNZh8egdlq2D_vsEiAySwH8t1Fn_w5zPoeDmCg4VCaBe6NZ2Os2EFD9Y8EepXlg',
            ],
        ];
    }

    /**
     * Simulasi tabel TEAMS + data member terdaftar (dari REGISTRATIONS).
     * current_member = COUNT(*) dari registrations WHERE team_id = x AND status != 'rejected'
     *
     * Field 'emoji', 'color', 'gradient' → simpan di tabel teams atau config terpisah.
     */
    private function getTeamsByEvent(int $eventId): array
    {
        $all = [

            /* ---- Event 1 — Futsal Santai Malam ---- */
            [
                // TEAMS columns
                'id'             => 1,
                'event_id'       => 1,
                'name'           => 'Harimau',
                'max_member'     => 20,
                'current_member' => 14,
                // tampilan
                'emoji'          => '🐯',
                'color'          => '#ef4444',
                'gradient'       => 'linear-gradient(135deg,#ef4444,#b91c1c)',
                // simulasi nama dari tabel REGISTRATIONS (status = confirmed/pending)
                'members' => [
                    'Ahmad Fauzi','Budi Santoso','Deni Firmansyah','Eko Prasetyo',
                    'Farid Hasan','Gunawan','Hendra Wijaya','Irfan Maulana',
                    'Jaka Susilo','Kurnia Adi','Lukman Hakim','Muhamad Rizki',
                    'Naufal Ihsan','Ozan Pratama',
                ],
            ],
            [
                'id'             => 2,
                'event_id'       => 1,
                'name'           => 'Elang',
                'max_member'     => 20,
                'current_member' => 11,
                'emoji'          => '🦅',
                'color'          => '#3b82f6',
                'gradient'       => 'linear-gradient(135deg,#3b82f6,#1d4ed8)',
                'members' => [
                    'Agus Riyanto','Bagas Ardianto','Cahyo Nugroho','Dimas Saputra',
                    'Erlangga','Fachrul Rozi','Habib Alwi','Ivan Setiawan',
                    'Joni Arifin','Khoirul Anwar','Luthfi Rahman',
                ],
            ],
            [
                'id'             => 3,
                'event_id'       => 1,
                'name'           => 'Macan',
                'max_member'     => 20,
                'current_member' => 20,    // penuh
                'emoji'          => '🐆',
                'color'          => '#64748b',
                'gradient'       => 'linear-gradient(135deg,#64748b,#334155)',
                'members' => [
                    'Abdul Ghani','Bambang Eko','Candra Wibowo','Dadang Kurnia',
                    'Edi Sanjaya','Faisal Akbar','Gilang Pramana','Haris Budiman',
                    'Ilham Basuki','Jefri Hidayat','Kamal Junaedi','Levi Andrianto',
                    'Miftah Farid','Nanang Wahyu','Oscar Pratama','Pras Utomo',
                    'Qori Salim','Reza Pahlevi','Sandi Kurniawan','Taufik Hidayat',
                ],
            ],
            [
                'id'             => 4,
                'event_id'       => 1,
                'name'           => 'Rajawali',
                'max_member'     => 20,
                'current_member' => 9,
                'emoji'          => '🦁',
                'color'          => '#f59e0b',
                'gradient'       => 'linear-gradient(135deg,#f59e0b,#b45309)',
                'members' => [
                    'Aldi Setiawan','Bintang Cahyo','Chandra Putra','Dion Firmanda',
                    'Evan Kusuma','Fikri Ramadhan','Galih Wicaksono','Hadi Nugroho',
                    'Imam Santoso',
                ],
            ],

            /* ---- Event 2 — Mini Soccer ---- */
            [
                'id'             => 5,
                'event_id'       => 2,
                'name'           => 'Garuda',
                'max_member'     => 14,
                'current_member' => 8,
                'emoji'          => '🦅',
                'color'          => '#ef4444',
                'gradient'       => 'linear-gradient(135deg,#ef4444,#b91c1c)',
                'members' => [
                    'Arif Budiman','Bayu Setiawan','Coki Ramadhan','Daffa Ardian',
                    'Ega Pratama','Feri Susanto','Galang Nugraha','Hani Saputra',
                ],
            ],
            [
                'id'             => 6,
                'event_id'       => 2,
                'name'           => 'Banteng',
                'max_member'     => 14,
                'current_member' => 6,
                'emoji'          => '🐂',
                'color'          => '#3b82f6',
                'gradient'       => 'linear-gradient(135deg,#3b82f6,#1d4ed8)',
                'members' => [
                    'Ibnu Malik','Jaka Permana','Karim Yusuf',
                    'Latif Hidayat','Mukhlis Amin','Nanda Putra',
                ],
            ],
            [
                'id'             => 7,
                'event_id'       => 2,
                'name'           => 'Kancil',
                'max_member'     => 14,
                'current_member' => 14,    // penuh
                'emoji'          => '🦌',
                'color'          => '#10b981',
                'gradient'       => 'linear-gradient(135deg,#10b981,#065f46)',
                'members' => [
                    'Oman Suherman','Panji Wicaksono','Qadri Fauzan','Rafi Adhitya',
                    'Sabri Idris','Teguh Santosa','Umar Faruq','Vino Akbar',
                    'Wahyu Andika','Xan Pradipta','Yusuf Hamdi','Zaini Abdi',
                    'Anto Wibowo','Boni Kurnia',
                ],
            ],
            [
                'id'             => 8,
                'event_id'       => 2,
                'name'           => 'Badak',
                'max_member'     => 14,
                'current_member' => 4,
                'emoji'          => '🦏',
                'color'          => '#f59e0b',
                'gradient'       => 'linear-gradient(135deg,#f59e0b,#b45309)',
                'members' => [
                    'Candra Maulana','Deni Wahyudi','Endi Prasetya','Fahmi Nuruddin',
                ],
            ],
        ];

        return array_values(array_filter($all, fn($t) => $t['event_id'] === $eventId));
    }

    // =========================================================================
    // HELPER METHODS
    // =========================================================================

    private function findEvent(int $id): array
    {
        foreach ($this->getEvents() as $event) {
            if ($event['id'] === $id) return $event;
        }
        abort(404, 'Event tidak ditemukan.');
    }

    private function findTeam(int $eventId, int $teamId): array
    {
        foreach ($this->getTeamsByEvent($eventId) as $team) {
            if ($team['id'] === $teamId) return $team;
        }
        abort(404, 'Tim tidak ditemukan.');
    }

    // =========================================================================
    // CONTROLLER ACTIONS
    // =========================================================================

    /**
     * GET /jadwal
     * Daftar semua event.
     */
    public function index()
    {
        $events = $this->getEvents();

        return view('schedule.index', compact('events'));
    }

    /**
     * GET /jadwal/{eventId}
     * Step 1 — Detail event.
     */
    public function show(int $eventId)
    {
        $event           = $this->findEvent($eventId);
        $teams           = $this->getTeamsByEvent($eventId);
        $totalRegistered = array_sum(array_column($teams, 'current_member'));

        return view('schedule.show', compact('event', 'teams', 'totalRegistered'));
    }

    /**
     * GET /jadwal/{eventId}/tim
     * Step 2 — Pilih tim.
     */
    public function teams(int $eventId)
    {
        $event = $this->findEvent($eventId);
        $teams = $this->getTeamsByEvent($eventId);

        return view('schedule.teams', compact('event', 'teams'));
    }

    /**
     * GET /jadwal/{eventId}/daftar/{teamId}
     * Step 3 — Form pendaftaran.
     */
    public function registerForm(int $eventId, int $teamId)
    {
        $event = $this->findEvent($eventId);
        $team  = $this->findTeam($eventId, $teamId);

        if ($team['current_member'] >= $team['max_member']) {
            return redirect()
                ->route('schedule.teams', $eventId)
                ->with('error', 'Tim ' . $team['name'] . ' sudah penuh. Silakan pilih tim lain.');
        }

        return view('schedule.register', compact('event', 'team'));
    }

    /**
     * POST /jadwal/{eventId}/daftar
     * Proses submit pendaftaran.
     *
     * TODO (setelah DB siap):
     *   $path = $request->file('bukti_tf')->store('bukti-transfer', 'public');
     *   Registration::create([
     *       'event_id'   => $eventId,
     *       'team_id'    => $request->team_id,
     *       'name'       => $request->name,
     *       'no_wa'      => $request->no_wa,
     *       'bukti_tf'   => $path,
     *       'status'     => 'pending',
     *       'expired_at' => now()->addHours(24),
     *   ]);
     *   Team::find($request->team_id)->increment('current_member');
     */
    public function registerStore(Request $request, int $eventId)
    {
        $event = $this->findEvent($eventId);

        $validated = $request->validate([
            'team_id'  => ['required', 'integer'],
            'name'     => ['required', 'string', 'max:100'],
            'no_wa'    => ['required', 'string', 'max:20'],
            'bukti_tf' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'notes'    => ['nullable', 'string', 'max:500'],
        ], [
            'team_id.required'  => 'Tim wajib dipilih.',
            'name.required'     => 'Nama lengkap wajib diisi.',
            'no_wa.required'    => 'Nomor WhatsApp wajib diisi.',
            'bukti_tf.required' => 'Bukti transfer wajib diunggah.',
            'bukti_tf.mimes'    => 'File harus berupa JPG, PNG, atau PDF.',
            'bukti_tf.max'      => 'Ukuran file maksimal 5 MB.',
        ]);

        // Simpan ke DB nanti — untuk sekarang langsung redirect dengan flash
        return redirect()
            ->route('schedule.show', $eventId)
            ->with('success',
                'Pendaftaran berhasil dikirim! Admin akan mengkonfirmasi dalam 1×24 jam via WhatsApp ke ' . $validated['no_wa'] . '.'
            );
    }


    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(Event $event)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
