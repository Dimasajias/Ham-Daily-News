import pandas as pd

data = [
    {
        "Poin": "a",
        "Rekomendasi": "Autentikasi dan Manajemen Sesi",
        "Status": "Selesai",
        "Keterangan Implementasi": "Sistem menggunakan autentikasi berlapis: (1) Password hashing Bcrypt 12-round; (2) Sesi berbasis database dengan enkripsi aktif (SESSION_ENCRYPT=true); (3) Masa berlaku sesi 300 menit; (4) Session regeneration setelah login untuk mencegah Session Fixation; (5) Session invalidation & regenerasi CSRF token saat logout; (6) Kebijakan password kuat (min 8 karakter, huruf besar+kecil, angka, simbol) dengan indikator kekuatan real-time.",
        "Bukti Kode": "BCRYPT_ROUNDS=12 | SESSION_DRIVER=database | SESSION_ENCRYPT=true | SESSION_LIFETIME=300\n$request->session()->regenerate()\n$request->session()->invalidate()\nPassword::min(8)->letters()->mixedCase()->numbers()->symbols()",
        "File Terkait": ".env (baris 16, 30-34)\nAuthenticatedSessionController.php (baris 46, 58-60)\nEditProfile.php",
        "Screenshot": "Halaman Login + Halaman Profil"
    },
    {
        "Poin": "b",
        "Rekomendasi": "Kontrol Akses",
        "Status": "Selesai",
        "Keterangan Implementasi": "RBAC menggunakan Spatie Laravel Permission dengan 2 peran: Admin (akses penuh) dan Regional (akses terbatas). Isolasi data: (1) Regional hanya lihat kegiatan miliknya (filter user_id); (2) Data Hoax diisolasi per kanwil (office_id); (3) Pengecekan peran di sisi server via hasRole(), tidak bisa dimanipulasi klien. Setiap resource memfilter data sesuai peran sebelum ditampilkan.",
        "Bukti Kode": "use Spatie\\Permission\\Traits\\HasRoles\nclass User { use HasRoles; }\nisAdmin(): return $this->hasRole('admin')\nActivityResource: if ($user->hasRole('regional')) { $query->where('user_id', $user->id); }\nHoaxResource: if (!$user->hasRole('admin')) { $query->where('office_id', $user->office_id); }",
        "File Terkait": "User.php (baris 13, 18, 66-74)\nActivityResource.php (baris 478-488)\nHoaxResource.php (baris 164-175)",
        "Screenshot": "Daftar User (/admin/users) kolom Role"
    },
    {
        "Poin": "c",
        "Rekomendasi": "Validasi Input dan Pencegahan Injeksi",
        "Status": "Selesai",
        "Keterangan Implementasi": "Pencegahan injeksi melalui: (1) Eloquent ORM (Prepared Statements) untuk semua query, SQL Injection tidak dimungkinkan; (2) Validasi form ketat (required, maxLength, email, integer); (3) CAPTCHA matematika di login yang dicocokkan dengan session; (4) Tidak ada raw SQL di seluruh aplikasi.",
        "Bukti Kode": "TextInput::make('extracted_title')->required()->maxLength(500)\nTextInput::make('title')->required()->maxLength(500)\nLoginRequest rules: 'email'=>['required','string','email'], 'captcha'=>['required','integer']",
        "File Terkait": "ActivityResource.php\nHoaxResource.php\nLoginRequest.php (baris 26-33)",
        "Screenshot": "Form Buat Kegiatan (/admin/activities/create)"
    },
    {
        "Poin": "d",
        "Rekomendasi": "Perlindungan Data dan Kriptografi",
        "Status": "Selesai",
        "Keterangan Implementasi": "Perlindungan data sensitif: (1) Password di-hash Bcrypt 12 rounds; (2) Cast 'hashed' otomatis hash setiap simpan; (3) Field password & remember_token di-hidden dari serialisasi JSON ($hidden); (4) Session terenkripsi (SESSION_ENCRYPT=true); (5) Ganti password wajib verifikasi password lama (currentPassword()).",
        "Bukti Kode": "protected $hidden = ['password','remember_token']\ncasts: 'password' => 'hashed'\nBCRYPT_ROUNDS=12\nSESSION_ENCRYPT=true\n->currentPassword()",
        "File Terkait": "User.php (baris 27-30, 32-38)\n.env (baris 16, 32)\nEditProfile.php",
        "Screenshot": "Screenshot kode User.php (cast hashed)"
    },
    {
        "Poin": "e",
        "Rekomendasi": "Penanganan Error dan Pencatatan Log",
        "Status": "Selesai",
        "Keterangan Implementasi": "Penanganan error aman: (1) Halaman error kustom (404, 500, 403, 401, 503) tanpa stack trace; (2) APP_DEBUG=false di produksi; (3) Log brute force otomatis (email, IP, user agent, durasi lockout); (4) Log channel 'stack' menulis ke file harian untuk audit trail.",
        "Bukti Kode": "Log::warning('BRUTE FORCE DETECTED', ['email'=>$this->email, 'ip'=>$this->ip(), 'user_agent'=>$this->userAgent()])\nAPP_ENV=production, APP_DEBUG=false\nCustom error views: resources/views/errors/layout.blade.php",
        "File Terkait": "LoginRequest.php (baris 96-101)\n.env\nresources/views/errors/layout.blade.php",
        "Screenshot": "Halaman Error 404 (URL sembarang)"
    },
    {
        "Poin": "f",
        "Rekomendasi": "Keamanan Komunikasi",
        "Status": "Selesai",
        "Keterangan Implementasi": "Seluruh komunikasi data dijamin aman melalui enkripsi SSL/TLS: (1) Aplikasi dikonfigurasi siap rilis (Production-Ready) menggunakan protokol HTTPS yang dipaksakan lewat URL::forceScheme('https'); (2) Pengalihan otomatis (force HTTPS) diterapkan di level server (.htaccess untuk Apache / Nginx Config) untuk menjamin tidak ada pertukaran data lewat HTTP biasa; (3) Cookie sesi dikonfigurasi dengan flag Secure dan HttpOnly secara default oleh Laravel, mencegah pembacaan session token oleh script berbahaya (XSS).",
        "Bukti Kode": "RewriteCond %{HTTPS} off\nRewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]\nAppServiceProvider.php: URL::forceScheme('https')",
        "File Terkait": "public/.htaccess\nconfig/session.php\nAppServiceProvider.php",
        "Screenshot": "Screenshot potongan kode di AppServiceProvider.php (baris 27-29) yang menunjukkan URL::forceScheme('https') karena aplikasi masih berjalan di local/belum rilis."
    },
    {
        "Poin": "g",
        "Rekomendasi": "Perlindungan terhadap Serangan Umum",
        "Status": "Selesai",
        "Keterangan Implementasi": "Perlindungan berlapis: (1) CAPTCHA matematika di login, mencegah bot; (2) Rate Limiting progresif: max 3 gagal=60dtk, 4-6 gagal=5mnt, 7+ gagal=15mnt; (3) CSRF token bawaan Laravel pada setiap form; (4) Throttle key berbasis email+IP; (5) Remember Me dinonaktifkan demi keamanan.",
        "Bukti Kode": "CAPTCHA: random_int(1,20), session()->put('captcha_answer', $answer)\nRateLimiter::tooManyAttempts($this->throttleKey(), 3)\nProgressive: >=7=>900, >=4=>300, default=>60\nAuth::attempt(..., false) // no remember",
        "File Terkait": "AuthenticatedSessionController.php (baris 19-35)\nLoginRequest.php (baris 51-76, 85-121)",
        "Screenshot": "Login dengan CAPTCHA + pesan rate limit"
    },
    {
        "Poin": "h",
        "Rekomendasi": "Keamanan API dan Web Service",
        "Status": "Selesai",
        "Keterangan Implementasi": "Sistem tertutup: (1) Route publik HANYA GET (baca data); (2) Tidak ada POST/PUT/DELETE terbuka; (3) Mutasi data HANYA via panel admin Filament + auth middleware; (4) /admin tanpa login = redirect ke login; (5) canAccessPanel() di model User memvalidasi akses.",
        "Bukti Kode": "Route publik (GET only): Route::get('/',...), Route::get('/kegiatan',...), Route::get('/hoax',...)\nTidak ada Route::post/put/delete di web.php\nPanel admin dilindungi auth middleware Filament",
        "File Terkait": "routes/web.php (baris 6-12)\nUser.php canAccessPanel()",
        "Screenshot": "Akses /admin tanpa login = redirect ke login"
    },
    {
        "Poin": "i",
        "Rekomendasi": "Pengelolaan File",
        "Status": "Selesai",
        "Keterangan Implementasi": "Upload diamankan: (1) Hanya tipe gambar (->image() validasi MIME server-side); (2) Maks 5MB (->maxSize(5120)); (3) Direktori terpisah (dokumentasi/); (4) Kompresi otomatis ke max 100KB; (5) Validasi MIME sebelum proses (hanya JPEG, PNG, WebP); (6) Konversi ke JPEG standar.",
        "Bukti Kode": "FileUpload::make('foto_dokumentasi')->image()->maxSize(5120)->disk('public')\ncompressImage(): match($imageInfo['mime']) { 'image/jpeg'=>..., 'image/png'=>..., default=>null }",
        "File Terkait": "ActivityResource.php (baris 126-138)\nCreateActivity.php (baris 59-147)",
        "Screenshot": "Form Upload Kegiatan (label maks 5MB)"
    },
    {
        "Poin": "j",
        "Rekomendasi": "Pengendalian Kode dan Dependensi",
        "Status": "Selesai",
        "Keterangan Implementasi": "Dependensi aman via Composer: (1) Laravel 12 (rilis terbaru, patch keamanan aktif); (2) Filament 3 (versi LTS); (3) PHP min 8.2 (dukungan keamanan aktif); (4) Spatie Permission 7.1; (5) composer.lock mengunci versi eksak; (6) optimize-autoloader aktif; (7) Dev dependencies TIDAK di produksi.",
        "Bukti Kode": "composer.json: php ^8.2, filament/filament ^3.0, laravel/framework ^12.0, spatie/laravel-permission ^7.1\ncomposer.lock mengunci versi\nconfig: optimize-autoloader: true",
        "File Terkait": "composer.json (baris 8-14, 79-88)",
        "Screenshot": "File composer.json bagian require"
    },
    {
        "Poin": "k",
        "Rekomendasi": "Keamanan Konfigurasi Sistem",
        "Status": "Selesai",
        "Keterangan Implementasi": "Konfigurasi aman: (1) APP_DEBUG=false di produksi; (2) APP_ENV=production; (3) Error pages kustom tanpa info teknis; (4) Password kuat diwajibkan (min 8, huruf besar+kecil, angka, simbol); (5) Verifikasi password lama sebelum ganti (currentPassword()); (6) Prinsip hak akses minimum (regional hanya akses data sendiri).",
        "Bukti Kode": "APP_ENV=production, APP_DEBUG=false\nPassword::min(8)->letters()->mixedCase()->numbers()->symbols()\n->currentPassword()\nCustom error pages",
        "File Terkait": ".env (produksi)\nEditProfile.php\nresources/views/errors/layout.blade.php",
        "Screenshot": "Halaman Profil (password lama + strength indicator)"
    },
    {
        "Poin": "l",
        "Rekomendasi": "Pengamanan Logika Bisnis",
        "Status": "Selesai",
        "Keterangan Implementasi": "Mencegah bypass logika: (1) Upload SELALU Pending (dipaksa backend, bukan form); (2) Field status TIDAK di form create; (3) Hanya admin punya tombol Approve/Reject; (4) Edit Approved = kembali Pending, approved_at tetap untuk audit; (5) approve()/reject() mencatat approved_by.",
        "Bukti Kode": "CreateActivity: $data['status'] = ActivityStatus::Pending\nEditActivity: if (Approved) { $data['status'] = Pending; unset($data['approved_at']); }\nActivity::approve(): update(['status'=>Approved, 'approved_by'=>$admin->id, 'approved_at'=>$this->approved_at??now()])",
        "File Terkait": "CreateActivity.php (baris 23)\nEditActivity.php (baris 15-34)\nActivity.php (baris 180-188)",
        "Screenshot": "Daftar Kegiatan (kolom Status) + Form Create (tanpa kolom Status)"
    }
]

df = pd.DataFrame(data)

writer = pd.ExcelWriter('Laporan_Keamanan_Aplikasi.xlsx', engine='xlsxwriter')
df.to_excel(writer, index=False, sheet_name='Audit Keamanan')

workbook = writer.book
worksheet = writer.sheets['Audit Keamanan']

# Header format
format_header = workbook.add_format({
    'bold': True,
    'bg_color': '#0A2B6B',
    'font_color': 'white',
    'border': 1,
    'text_wrap': True,
    'valign': 'vcenter',
    'align': 'center'
})

# Text format
format_text = workbook.add_format({
    'text_wrap': True,
    'valign': 'top',
    'border': 1,
    'font_size': 10
})

# Code format
format_code = workbook.add_format({
    'text_wrap': True,
    'valign': 'top',
    'border': 1,
    'font_size': 9,
    'font_name': 'Consolas'
})

# Poin format
format_poin = workbook.add_format({
    'text_wrap': True,
    'valign': 'top',
    'border': 1,
    'font_size': 10,
    'align': 'center',
    'bold': True
})

# Status format
format_status = workbook.add_format({
    'text_wrap': True,
    'valign': 'top',
    'border': 1,
    'font_size': 10,
    'bold': True,
    'font_color': '#166534',
    'bg_color': '#dcfce7'
})

for col_num, value in enumerate(df.columns.values):
    worksheet.write(0, col_num, value, format_header)

# Write data with formatting
for row_num in range(len(df)):
    worksheet.write(row_num + 1, 0, df.iloc[row_num]['Poin'], format_poin)
    worksheet.write(row_num + 1, 1, df.iloc[row_num]['Rekomendasi'], format_text)
    worksheet.write(row_num + 1, 2, df.iloc[row_num]['Status'], format_status)
    worksheet.write(row_num + 1, 3, df.iloc[row_num]['Keterangan Implementasi'], format_text)
    worksheet.write(row_num + 1, 4, df.iloc[row_num]['Bukti Kode'], format_code)
    worksheet.write(row_num + 1, 5, df.iloc[row_num]['File Terkait'], format_code)
    worksheet.write(row_num + 1, 6, df.iloc[row_num]['Screenshot'], format_text)

# Column widths
worksheet.set_column('A:A', 5)
worksheet.set_column('B:B', 22)
worksheet.set_column('C:C', 12)
worksheet.set_column('D:D', 55)
worksheet.set_column('E:E', 45)
worksheet.set_column('F:F', 25)
worksheet.set_column('G:G', 25)

# Row heights
for row_num in range(len(df)):
    worksheet.set_row(row_num + 1, 120)

writer.close()
print("✅ Laporan_Keamanan_Aplikasi.xlsx berhasil dibuat!")
