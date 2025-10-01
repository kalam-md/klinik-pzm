<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik - Sistem Manajemen Klinik Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Navbar -->
    <nav class="fixed w-full bg-white shadow-md z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-heartbeat text-3xl text-purple-600"></i>
                    <span class="text-2xl font-bold text-gray-800">Klinik</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-gray-700 hover:text-purple-600 transition">Beranda</a>
                    <a href="#fitur" class="text-gray-700 hover:text-purple-600 transition">Fitur</a>
                    <a href="#cara-kerja" class="text-gray-700 hover:text-purple-600 transition">Cara Kerja</a>
                    <a href="#tentang" class="text-gray-700 hover:text-purple-600 transition">Tentang</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('beranda') }}" class="px-6 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 transition">Masuk</a>
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="gradient-bg pt-32 pb-20">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-white mb-10 md:mb-0">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Kelola Kesehatan Anda dengan Mudah
                    </h1>
                    <p class="text-xl mb-8 text-purple-100">
                        Sistem manajemen klinik modern untuk pendaftaran online, antrian digital, dan rekam medis elektronik yang aman.
                    </p>
                    <div class="flex space-x-4">
                        @guest
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-purple-600 rounded-full font-semibold hover:bg-gray-100 transition transform hover:scale-105">
                                Mulai Sekarang
                            </a>
                            <a href="#fitur" class="px-8 py-4 border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-purple-600 transition">
                                Pelajari Lebih Lanjut
                            </a>
                        @else
                            <a href="{{ route('beranda') }}" class="px-8 py-4 bg-white text-purple-600 rounded-full font-semibold hover:bg-gray-100 transition transform hover:scale-105">
                                Ke Dashboard
                            </a>
                        @endguest
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="float-animation">
                        <i class="fas fa-hospital text-white" style="font-size: 300px; opacity: 0.9;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <i class="fas fa-users text-5xl text-purple-600 mb-4"></i>
                    <h3 class="text-4xl font-bold text-gray-800 mb-2">1000+</h3>
                    <p class="text-gray-600">Pasien Terdaftar</p>
                </div>
                <div class="p-6">
                    <i class="fas fa-user-md text-5xl text-purple-600 mb-4"></i>
                    <h3 class="text-4xl font-bold text-gray-800 mb-2">50+</h3>
                    <p class="text-gray-600">Dokter Berpengalaman</p>
                </div>
                <div class="p-6">
                    <i class="fas fa-clinic-medical text-5xl text-purple-600 mb-4"></i>
                    <h3 class="text-4xl font-bold text-gray-800 mb-2">15+</h3>
                    <p class="text-gray-600">Poli Klinik</p>
                </div>
                <div class="p-6">
                    <i class="fas fa-clock text-5xl text-purple-600 mb-4"></i>
                    <h3 class="text-4xl font-bold text-gray-800 mb-2">24/7</h3>
                    <p class="text-gray-600">Layanan Online</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600">Kemudahan akses layanan kesehatan di ujung jari Anda</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-calendar-check text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Pendaftaran Online</h3>
                    <p class="text-gray-600">Daftar kunjungan ke dokter kapan saja dan di mana saja tanpa perlu antri di loket.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-list-ol text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Antrian Digital</h3>
                    <p class="text-gray-600">Pantau nomor antrian Anda secara real-time dan datang tepat waktu saat giliran tiba.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-file-medical text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Rekam Medis Digital</h3>
                    <p class="text-gray-600">Akses riwayat kesehatan dan rekam medis Anda dengan aman kapan pun dibutuhkan.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-stethoscope text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Multi Poli Klinik</h3>
                    <p class="text-gray-600">Berbagai pilihan poli klinik dengan dokter spesialis berpengalaman.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-clock text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Jadwal Fleksibel</h3>
                    <p class="text-gray-600">Lihat jadwal praktik dokter dan pilih waktu yang sesuai dengan kebutuhan Anda.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Keamanan Terjamin</h3>
                    <p class="text-gray-600">Data kesehatan Anda dilindungi dengan sistem keamanan tingkat tinggi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="cara-kerja" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Cara Kerja</h2>
                <p class="text-xl text-gray-600">Mudah dan cepat dalam 4 langkah</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Akun</h3>
                    <p class="text-gray-600">Buat akun dengan mengisi data diri Anda secara lengkap dan aman.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Pilih Poli & Dokter</h3>
                    <p class="text-gray-600">Pilih poli klinik dan dokter sesuai kebutuhan kesehatan Anda.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Online</h3>
                    <p class="text-gray-600">Pilih jadwal yang tersedia dan dapatkan nomor antrian otomatis.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl font-bold">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Datang & Berobat</h3>
                    <p class="text-gray-600">Datang sesuai jadwal dan nomor antrian untuk mendapat pelayanan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-1/2">
                    <i class="fas fa-hospital-user text-purple-600" style="font-size: 250px;"></i>
                </div>
                <div class="md:w-1/2">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Tentang Kami</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Kami adalah platform sistem manajemen klinik yang berkomitmen untuk memberikan kemudahan akses layanan kesehatan bagi masyarakat. Dengan teknologi digital terkini, kami menghadirkan solusi yang efisien dan user-friendly.
                    </p>
                    <p class="text-lg text-gray-600 mb-6">
                        Misi kami adalah menjembatani pasien dengan tenaga medis profesional melalui sistem yang terintegrasi, aman, dan dapat diandalkan.
                    </p>
                    <div class="flex items-center space-x-6">
                        <div>
                            <i class="fas fa-check-circle text-3xl text-green-500"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">Terpercaya</h4>
                            <p class="text-gray-600">Sistem terverifikasi dan aman</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6 mt-4">
                        <div>
                            <i class="fas fa-check-circle text-3xl text-green-500"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">Profesional</h4>
                            <p class="text-gray-600">Dokter dan tenaga medis berpengalaman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Siap Untuk Memulai?
            </h2>
            <p class="text-xl text-purple-100 mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan pengguna yang telah merasakan kemudahan layanan kesehatan digital kami.
            </p>
            @guest
                <a href="{{ route('register') }}" class="inline-block px-10 py-4 bg-white text-purple-600 rounded-full font-semibold hover:bg-gray-100 transition transform hover:scale-105 text-lg">
                    Daftar Sekarang Gratis
                </a>
            @else
                <a href="{{ route('beranda') }}" class="inline-block px-10 py-4 bg-white text-purple-600 rounded-full font-semibold hover:bg-gray-100 transition transform hover:scale-105 text-lg">
                    Ke Dashboard
                </a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-heartbeat text-3xl text-purple-500"></i>
                        <span class="text-2xl font-bold">Klinik</span>
                    </div>
                    <p class="text-gray-400">
                        Sistem manajemen klinik modern untuk kemudahan akses layanan kesehatan.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-purple-500 transition">Pendaftaran Online</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition">Antrian Digital</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition">Rekam Medis</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition">Jadwal Dokter</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Tentang</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#tentang" class="hover:text-purple-500 transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition">Kontak</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition">Karir</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-phone"></i>
                            <span>+62 812 3456 7890</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-envelope"></i>
                            <span>info@klinik.com</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Jakarta, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Klinik. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg');
            } else {
                nav.classList.remove('shadow-lg');
            }
        });
    </script>
</body>
</html>