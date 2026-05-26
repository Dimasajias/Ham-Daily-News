<script>
    // ──── Navbar Scroll & Toggles ────
    const navbar = document.getElementById('navbar');
    if(navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 30);
        });
    }

    const mobileBtn = document.querySelector('.mobile-menu-btn');
    const mobileMenu = document.querySelector('.navbar-menu');
    const overlay = document.querySelector('.mobile-overlay');

    if (mobileBtn && mobileMenu && overlay) {
        mobileBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
            overlay.classList.toggle('open');
            if (mobileMenu.classList.contains('open')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });

        overlay.addEventListener('click', () => {
            mobileMenu.classList.remove('open');
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        });
    }

    document.querySelectorAll('.navbar-dropdown > a').forEach(item => {
        item.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                this.parentElement.classList.toggle('is-active');
            }
        });
    });

    // ──── Language Translation Dict ────
    const translations = {
        id: {
            login: 'Login Staff',
            ministry: 'Kementerian Hak Asasi Manusia',
            hero_title: '<span>HAM</span> DAILY NEWS',
            hero_desc: 'Portal agregasi kegiatan harian dari seluruh Unit Kerja, Kantor Wilayah, dan Wilayah Kerja Kementerian Hak Asasi Manusia di Indonesia. Konten dikurasi langsung dari media sosial resmi.',
            hero_cta: 'Lihat Kegiatan',
            activities: 'Publikasi',
            regional_offices: 'Unit Kerja',
            today: 'Hari Ini',
            search_placeholder: 'Cari kegiatan...',
            office_search_placeholder: 'Cari Unit Kerja...',
            filter: 'Filter',
            search_btn: 'Cari',
            reset: 'Reset',
            export_excel: 'Export Excel',
            kanwil_label: 'UNIT KERJA',
            unit_label: 'WILKER',
            from_date: 'DARI TANGGAL',
            to_date: 'SAMPAI TANGGAL',
            all_kanwil: 'Semua Unit',
            active_filters: 'Filter aktif:',
            latest_activities: 'Kegiatan Terbaru',
            published: 'dipublikasikan',
            fact_check_title: 'Cek Fakta & <span>Anti Hoax</span><br>Kemenham',
            hoax_hero_desc: 'Kementerian Hak Asasi Manusia berkomitmen melawan disinformasi. Temukan klarifikasi resmi dan debunking berita hoax yang berkaitan dengan HAM di Indonesia.',
            search_placeholder_hoax: 'Cari judul berita hoax...',
            no_hoax_data: 'Belum ada data berita hoax',
            no_hoax_desc: 'Saat ini belum ada berita hoax yang dipublikasikan.',
            no_results: 'Tidak Ada Kegiatan Ditemukan',
            no_results_desc: 'Coba ubah filter pencarian atau <a href=\"/\" style=\"color: var(--blue); font-weight: 600;\">reset semua filter</a>.',
            footer: 'Kementerian Hak Asasi Manusia Republik Indonesia',
            footer_desc: 'Portal Kegiatan Harian Kementerian Hak Asasi Manusia Republik Indonesia. Menampilkan kegiatan dan publikasi resmi dari seluruh Unit Kerja, Kantor Wilayah, dan Wilayah Kerja.',
            footer_links: 'Tautan',
            nav_home: 'Beranda',
            official_website: 'Website Resmi',
            nav_login: 'Login Admin',
            contact_us: 'Hubungi Kami',
            phone: 'Telepon',
            our_address: 'Alamat',
            about: 'Tentang',
            grid_title: 'Mode Ikon (Dengan Gambar)',
            list_title: 'Mode Daftar (Tanpa Gambar)',
            chip_from: 'Dari',
            chip_to: 'Sampai',
            read_more: 'Lihat selengkapnya...',
            offices_page_title: 'Unit Kerja & Kantor Wilayah',
            offices_page_desc: 'Daftar seluruh Unit Kerja, Kantor Wilayah, dan Wilayah Kerja Kementerian Hak Asasi Manusia yang terintegrasi dalam portal kegiatan harian.',
            total_offices: 'Total Kantor',
            total_activities: 'Total Kegiatan',
            today_activities: 'Kegiatan Hari Ini',
            today_label: 'hari ini',
            activities_label: 'Kegiatan',
            today_label2: 'Hari Ini',
            fact_check_label: 'Klarifikasi & Penjelasan Resmi',
            visit_source: 'Kunjungi Link Sumber Asli',
            staff_team: 'Tim HAMDANS',
            fact_check_result: 'Hasil Cek Fakta',
            related_hoax: 'Berita Hoax Lainnya',
            back_to_list: 'Kembali ke Daftar',
            view_location: 'Lihat Lokasi',
            hoax_news: 'Berita Hoax',
            verdict_hoax: 'HOAX',
            verdict_fact: 'FAKTA',
            all_hoax: 'Semua Berita Hoax',
            submitted_by: 'Disubmit oleh',
            approved: 'Disetujui',
            office_label: 'Kantor Wilayah',
            source: 'Sumber Asli',
            back_portal: 'Kembali ke Portal',
            all_platforms: 'Semua',
            no_results_desc_kegiatan: 'Coba ubah filter pencarian atau <a href="/kegiatan">reset semua filter</a>.',
            portal_berita: 'Portal Berita',
            trend_7_days: 'Trend Kegiatan (7 Hari Terakhir)',
            live_data: 'Live Data',
            platform_distribution: 'Distribusi per Platform',
            kegiatan_hero_eyebrow: 'Portal Kegiatan Resmi',
            kegiatan_hero_title: 'Seluruh <em>Kegiatan</em><br>Kemenham',
            kegiatan_hero_desc: 'Rekap kegiatan harian dari seluruh Unit Kerja, Kantor Wilayah, dan Wilayah Kerja Kementerian Hak Asasi Manusia, dikurasi dari kanal media sosial resmi.',
            unit_prefix: 'Unit:',
            all_publications: 'Semua Publikasi'
        },
        en: {
            login: 'Staff Login',
            ministry: 'Ministry of Human Rights Republic of Indonesia',
            hero_title: '<span>HAM</span> DAILY NEWS',
            hero_desc: 'Daily activity aggregation portal from all Work Units, Regional Offices, and Work Areas of the Ministry of Human Rights in Indonesia. Content curated directly from official social media.',
            hero_cta: 'View Activities',
            activities: 'Publications',
            regional_offices: 'Work Units',
            today: 'Today',
            search_placeholder: 'Search for activities, offices, or topics...',
            office_search_placeholder: 'Search Work Units...',
            filter: 'Filter',
            search_btn: 'Search',
            reset: 'Reset',
            export_excel: 'Export Excel',
            kanwil_label: 'WORK UNIT',
            unit_label: 'WORK AREA',
            from_date: 'FROM DATE',
            to_date: 'TO DATE',
            all_kanwil: 'All Units',
            active_filters: 'Active filters:',
            latest_activities: 'Latest Activities',
            published: 'published',
            fact_check_title: 'Fact Check & <span>Anti-Hoax</span><br>Kemenham',
            hoax_hero_desc: 'The Ministry of Human Rights is committed to fighting disinformation. Find official clarifications and debunking of hoax news related to Human Rights in Indonesia.',
            search_placeholder_hoax: 'Search hoax titles...',
            no_hoax_data: 'No hoax reports yet',
            no_hoax_desc: 'Currently, there are no hoax reports published.',
            no_results: 'No Activities Found',
            no_results_desc: 'Try changing your search filters or <a href=\"/\" style=\"color: var(--blue); font-weight: 600;\">reset all filters</a>.',
            footer: 'Ministry of Human Rights Republic of Indonesia',
            footer_desc: 'Daily Activity Portal of the Ministry of Human Rights of the Republic of Indonesia. Showcasing official activities and publications from all Work Units, Regional Offices, and Work Areas.',
            footer_links: 'Links',
            nav_home: 'Home',
            official_website: 'Official Website',
            nav_login: 'Admin Login',
            contact_us: 'Contact Us',
            phone: 'Phone',
            our_address: 'Address',
            about: 'About',
            grid_title: 'Grid View (With Images)',
            list_title: 'List View (No Images)',
            chip_from: 'From',
            chip_to: 'To',
            read_more: 'Read more...',
            offices_page_title: 'Work Units & Regional Offices',
            offices_page_desc: 'List of all Work Units, Regional Offices, and Work Areas of the Ministry of Human Rights integrated into the daily activity portal.',
            total_offices: 'Total Offices',
            total_activities: 'Total Activities',
            today_activities: 'Activities Today',
            today_label: 'today',
            activities_label: 'Activities',
            today_label2: 'Today',
            fact_check_label: 'Official Clarification & Explanation',
            visit_source: 'Visit Original Source Link',
            staff_team: 'HAMDANS Team',
            fact_check_result: 'Fact Check Result',
            related_hoax: 'Other Hoax Reports',
            back_to_list: 'Back to List',
            view_location: 'View Location',
            hoax_news: 'Hoax Reports',
            verdict_hoax: 'HOAX',
            verdict_fact: 'FACT',
            all_hoax: 'All Hoax Reports',
            submitted_by: 'Submitted by',
            approved: 'Approved',
            office_label: 'Regional Office',
            source: 'Original Source',
            back_portal: 'Back to Portal',
            all_platforms: 'All',
            no_results_desc_kegiatan: 'Try changing your search filters or <a href="/kegiatan">reset all filters</a>.',
            portal_berita: 'News Portal',
            trend_7_days: 'Activity Trend (Last 7 Days)',
            live_data: 'Live Data',
            platform_distribution: 'Distribution by Platform',
            kegiatan_hero_eyebrow: 'Official Activity Portal',
            kegiatan_hero_title: 'All <em>Activities</em><br>of Kemenham',
            kegiatan_hero_desc: 'Daily activity recap from all Work Units, Regional Offices, and Work Areas of the Ministry of Human Rights, curated from official social media channels.',
            unit_prefix: 'Unit:',
            all_publications: 'All Publications'
        }
    };

    function setLang(lang) {
        localStorage.setItem('hamdans_lang', lang);
        document.documentElement.lang = lang;

        const langLabel = document.getElementById('currentLangLabel');
        if(langLabel) langLabel.textContent = lang.toUpperCase();

        // Standard Text Translation
        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.dataset.i18n;
            if (translations[lang] && translations[lang][key]) {
                el.innerHTML = translations[lang][key];
            }
        });

        // Attribute Translation (Placeholder, Title, Alt)
        const attrMap = {
            'data-i18n-placeholder': 'placeholder',
            'data-i18n-title': 'title',
            'data-i18n-alt': 'alt'
        };

        Object.entries(attrMap).forEach(([attr, prop]) => {
            document.querySelectorAll(`[${attr}]`).forEach(el => {
                const key = el.getAttribute(attr);
                if (translations[lang] && translations[lang][key]) {
                    el[prop] = translations[lang][key];
                }
            });
        });

        // Special Case: Pagination
        document.querySelectorAll('.pagination-wrapper p, [role="navigation"] p, .text-sm, .result-label').forEach(el => {
            const text = el.textContent.trim();
            const match = text.match(/(?:Showing|Menampilkan)\s*([\d,.]+)\s*(?:to|sampai|-|–|—|hingga)\s*([\d,.]+)\s*(?:of|dari)\s*([\d,.]+)\s*(?:results|hasil|kegiatan)/i);
            if (match) {
                const [, from, to, total] = match;
                el.innerHTML = lang === 'en'
                    ? `Showing <strong>${from}–${to}</strong> of <strong>${total}</strong> results`
                    : `Menampilkan <strong>${from}–${to}</strong> dari <strong>${total}</strong> kegiatan`;
            }
        });

        // Translate and format dynamic times based on local timezone
        const locale = lang === 'en' ? 'en-US' : 'id-ID';
        document.querySelectorAll('.dynamic-time').forEach(el => {
            const timeStr = el.getAttribute('data-time');
            if (!timeStr) return;
            const date = new Date(timeStr);
            if (isNaN(date)) return;

            const format = el.getAttribute('data-format');
            
            if (format === 'diffForHumans') {
                const diffMs = Date.now() - date.getTime();
                const diffSecs = Math.floor(diffMs / 1000);
                const diffMins = Math.floor(diffSecs / 60);
                const diffHours = Math.floor(diffMins / 60);
                const diffDays = Math.floor(diffHours / 24);
                
                let timeAgoStr = '';
                if (diffSecs < 60) timeAgoStr = lang === 'en' ? `just now` : `baru saja`;
                else if (diffMins < 60) timeAgoStr = lang === 'en' ? `${diffMins} minute${diffMins > 1 ? 's' : ''} ago` : `${diffMins} menit yang lalu`;
                else if (diffHours < 24) timeAgoStr = lang === 'en' ? `${diffHours} hour${diffHours > 1 ? 's' : ''} ago` : `${diffHours} jam yang lalu`;
                else if (diffDays < 7) timeAgoStr = lang === 'en' ? `${diffDays} day${diffDays > 1 ? 's' : ''} ago` : `${diffDays} hari yang lalu`;
                else if (diffDays < 30) timeAgoStr = lang === 'en' ? `${Math.floor(diffDays/7)} week${Math.floor(diffDays/7) > 1 ? 's' : ''} ago` : `${Math.floor(diffDays/7)} minggu yang lalu`;
                else if (diffDays < 365) timeAgoStr = lang === 'en' ? `${Math.floor(diffDays/30)} month${Math.floor(diffDays/30) > 1 ? 's' : ''} ago` : `${Math.floor(diffDays/30)} bulan yang lalu`;
                else timeAgoStr = lang === 'en' ? `${Math.floor(diffDays/365)} year${Math.floor(diffDays/365) > 1 ? 's' : ''} ago` : `${Math.floor(diffDays/365)} tahun yang lalu`;

                const innerFormat = el.getAttribute('data-inner-format');
                if (innerFormat === 'time') {
                    const timeStrFormatted = date.toLocaleTimeString(locale, { hour: '2-digit', minute: '2-digit', hour12: false });
                    el.innerHTML = `${timeAgoStr} &bull; ${timeStrFormatted}`;
                } else {
                    el.innerHTML = timeAgoStr;
                }
            } else if (format === 'time') {
                el.innerHTML = date.toLocaleTimeString(locale, { hour: '2-digit', minute: '2-digit', hour12: false });
            } else if (format === 'date') {
                el.innerHTML = date.toLocaleDateString(locale, { day: 'numeric', month: 'long', year: 'numeric' });
            } else if (format === 'full') {
                const dateStr = date.toLocaleDateString(locale, { day: 'numeric', month: 'long', year: 'numeric' });
                const timeStrFormatted = date.toLocaleTimeString(locale, { hour: '2-digit', minute: '2-digit', hour12: false });
                el.innerHTML = `${dateStr}, ${timeStrFormatted}`;
            }
        });

        // Special Case: Search Filter Active Labels
        const kanwilSelect = document.getElementById('kanwil');
        if (kanwilSelect && kanwilSelect.options[0]) kanwilSelect.options[0].text = translations[lang].all_kanwil;
        
        const afLabel = document.querySelector('.active-filters .label');
        if (afLabel) afLabel.textContent = translations[lang].active_filters;
    }

    document.addEventListener('DOMContentLoaded', () => {
        let savedLang = localStorage.getItem('hamdans_lang');
        
        // Auto-detect if no saved preference
        if (!savedLang) {
            const browserLang = navigator.language || navigator.userLanguage;
            savedLang = browserLang.startsWith('en') ? 'en' : 'id';
        }
        
        setLang(savedLang);
        
        // Smooth transition trigger
        document.body.classList.add('i18n-ready');
    });

    // Handle language switch from UI
    window.setLang = setLang;
</script>
