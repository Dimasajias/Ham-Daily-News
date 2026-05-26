<x-filament-widgets::widget>
    <x-filament::section collapsible :collapsed="true" id="tutorial-widget-section">
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-book-open class="w-6 h-6 text-primary-500" />
                <span class="text-lg font-bold">Panduan & Tutorial Penggunaan</span>
            </div>
        </x-slot>

        <div class="prose dark:prose-invert max-w-none">
            <p class="text-gray-700 dark:text-gray-200 text-sm mb-4">Selamat datang di Portal HAMDANS! Berikut adalah panduan singkat cara melakukan pengunggahan kegiatan dan berita hoax untuk memastikan data terpublikasi dengan baik.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <!-- Panduan Kegiatan -->
                <div class="bg-gray-50 dark:bg-white/5 p-5 rounded-xl border border-gray-200 dark:border-white/10">
                    <h3 class="text-md font-bold text-primary-600 dark:text-primary-400 mb-3 flex items-center gap-2">
                        <x-heroicon-o-document-text class="w-5 h-5" /> Upload Kegiatan
                    </h3>
                    <ul class="list-disc pl-5 space-y-2 text-sm text-gray-800 dark:text-gray-200">
                        <li>Masuk ke menu <strong class="text-gray-900 dark:text-white">Kegiatan</strong> di sidebar sebelah kiri.</li>
                        <li>Klik tombol <strong class="text-gray-900 dark:text-white">Submit Kegiatan</strong> di pojok kanan atas.</li>
                        <li>Isi formulir dengan lengkap. URL dari sosial media (Instagram, TikTok, dll) wajib dimasukkan di bagian <em>Link Media Sosial</em>.</li>
                        <li>Upload foto dokumentasi kegiatan (Maksimal 5MB, otomatis dikompres oleh sistem tanpa merusak resolusi).</li>
                        <li>Klik <strong class="text-gray-900 dark:text-white">Kirim Kegiatan</strong>. Data akan masuk dalam status <em>Pending</em> dan menunggu persetujuan dari Pusat.</li>
                    </ul>
                </div>

                <!-- Panduan Hoax -->
                <div class="bg-gray-50 dark:bg-white/5 p-5 rounded-xl border border-gray-200 dark:border-white/10">
                    <h3 class="text-md font-bold text-danger-600 dark:text-danger-400 mb-3 flex items-center gap-2">
                        <x-heroicon-o-shield-exclamation class="w-5 h-5" /> Upload Berita Hoax
                    </h3>
                    <ul class="list-disc pl-5 space-y-2 text-sm text-gray-800 dark:text-gray-200">
                        <li>Masuk ke menu <strong class="text-gray-900 dark:text-white">Berita Hoax</strong> di sidebar.</li>
                        <li>Klik tombol <strong class="text-gray-900 dark:text-white">Buat Berita Hoax</strong> di pojok kanan atas.</li>
                        <li>Tuliskan judul hoax yang beredar di masyarakat dengan jelas.</li>
                        <li>Pada bagian <em>Isi / Klarifikasi Berita</em>, berikan penjelasan komprehensif mengapa berita tersebut salah beserta fakta yang sebenarnya.</li>
                        <li>Upload gambar tangkapan layar (screenshot) bukti berita hoax tersebut.</li>
                        <li>Pastikan toggle "Publikasikan ke Halaman Publik" diaktifkan jika data siap tayang.</li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-6 p-4 bg-primary-50 dark:bg-primary-500/10 rounded-xl border border-primary-100 dark:border-primary-500/20 flex items-start gap-3">
                <x-heroicon-o-information-circle class="w-6 h-6 text-primary-600 dark:text-primary-400 flex-shrink-0 mt-0.5" />
                <p class="text-sm text-primary-900 dark:text-primary-100 m-0 leading-relaxed">
                    <strong class="text-primary-900 dark:text-primary-50">Catatan Penting Sistem:</strong><br>
                    - Anda hanya dapat melihat dan mengubah data yang dibuat oleh Unit Kerja Anda sendiri.<br>
                    - Platform media sosial (Instagram, Facebook, X/Twitter, Youtube, Tiktok) akan dideteksi secara otomatis dari URL yang Anda tautkan.
                </p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
