<div id="mainNavbar" class="bg-primary mx-auto w-full sticky z-40 top-0 right-0 left-0 transition-opacity duration-500">
    <!-- Navigation -->
    <nav class="flex justify-between items-center container mx-auto max-w-full py-4">
        <a href="/" class=" flex items-center gap-4 justify-center px-6">
            <img class="w-20 " src="/logoman.webp" alt="">
            <div class="">
                <h1 class=" text-xl font-bold text-white font-poppins">MAN 1 KOTA BOGOR</h1>
                <h1 class=" text-md text-white font-poppins">Terwujudnya Insan Madrasah yang Berprestasi</h1>
                <h1 class=" text-md text-white font-poppins">Terampil dan Berkahlakul Karimah</h1>
            </div>
        </a>
        <div class="items-center flex">
            <div class="py-4 px-6 lg:flex hidden gap-4">
                @if (Auth::check())
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-white outline px-9 py-4 rounded-full font-bold text-sm hover:bg-secondary hover:text-primary">Dashboard</a>
                @endif
            </div>
        </div>

        <button class="py-4 px-6 lg:hidden block buttonDown text-white">
            <svg width="35" height="35" viewBox="0 0 448 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" fill="white"/>
            </svg>
        </button>
    </nav>
    <div
        class="hidden items-center justify-center lg:flex lg:bg-gradient-to-b from-primary to-tertiary transition-colors">
        <div class=" h-14 items-center flex">
            <ul class="text-white text-xs xl:text-base font-semibold  lg:flex gap-4 hidden">
                <li>
                    <x-side-nav :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-side-nav>
                </li>
                <li class="relative hover:text-tertiary" x-data="{ dropdown: false }">
                    <button
                        @click="dropdown = !dropdown"
                        :class="{
                            'bg-white text-tertiary': dropdown,
                            'hover:bg-white hover:text-tertiary': true
                        }"
                        class="focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg"
                    >
                        Profil Sekolah
                    </button>
                    <!-- Dropdown -->
                    <div class="lg:absolute bg-primary z-10 text-tertiary rounded-md right-0 my-2 p-2" x-show="dropdown"
                        @click.outside="dropdown = false">
                        <ul class="space-y-2 w-48">
                            <li><a href="/sejarah"
                                    class="flex p-2 font-medium text-white rounded-md hover:bg-white hover:text-tertiary">Sejarah</a>
                            </li>
                            <li><a href="/visimisi"
                                    class="flex p-2 font-medium text-white rounded-md hover:bg-white hover:text-tertiary">Visi
                                    Misi</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <x-side-nav :href="route('guest.news')" :active="request()->routeIs('guest.news')">
                        {{ __('Berita Sekolah') }}
                    </x-side-nav>
                </li>
                <li>
                    <x-side-nav :href="route('guest.fasilitas')" :active="request()->routeIs('guest.fasilitas')">
                        {{ __('Fasilitas') }}
                    </x-side-nav>
                </li>
                <li>
                    <x-side-nav :href="route('guest.prestasi')" :active="request()->routeIs('guest.prestasi')">
                        {{ __('Prestasi') }}
                    </x-side-nav>
                </li>
                <li>
                    <x-side-nav :href="route('guest.faq')" :active="request()->routeIs('guest.faq')">
                        {{ __('FAQ') }}
                    </x-side-nav>
                </li>
                <li>
                    <x-side-nav :href="route('guest.agenda')" :active="request()->routeIs('guest.agenda')">
                        {{ __('Agenda Kegiatan') }}
                    </x-side-nav>
                </li>
                <li>
                    <x-side-nav :href="route('guest.survey')" :active="request()->routeIs('guest.survey')">
                        {{ __('Survey & Kritik Saran') }}
                    </x-side-nav>
                </li>
                <li
                    class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                    <a href="{{ env('PPDB_URL') }}">PPDB</a>
                </li>
                <!-- <li>
                    <x-side-nav :href="route('guest.publikasi')" :active="request()->routeIs('guest.publikasi')">
                        {{ __('Publikasi') }}
                    </x-side-nav>
                </li> -->


            </ul>
        </div>
    </div>
    <div class="mobileMenu hidden lg:hidden">
        <ul class=" text-sm text-center text-white font-bold gap-8 bg-gradient-to-b from-primary to-tertiary">
            <li
                class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li
                class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="{{ route('guest.profilsekolah') }}">Profil Sekolah</a>
            </li>
            <li
                class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="{{ route('guest.news') }}">Berita Sekolah</a>
            </li>
            <li
                class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="{{ route('guest.fasilitas') }}">Fasilitas</a>
            </li>
            <li
                class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="{{ route('guest.prestasi') }}">Prestasi</a>
            </li>
            <li
                class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="{{ route('guest.faq') }}">FAQ</a>
            </li>
            <li
                class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="{{ route('guest.agenda') }}">Agenda Kegiatan</a>
            </li>
            <li
                class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="{{ route('guest.survey') }}">Survey & Kritik Saran</a>
            </li>
            <li
                class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                <a href="{{ env('PPDB_URL') }}">PPDB</a>
            </li>
        </ul>
    </div>
<!-- Fade Navbar Script & CSS -->
<style>
    #mainNavbar.fade-out {
        opacity: 0;
        pointer-events: none;
    }
    #mainNavbar.fade-in {
        opacity: 1;
        pointer-events: auto;
    }
</style>
<script>
    let lastScrollTop = 0;
    const navbar = document.getElementById('mainNavbar');
    const mobileMenu = document.querySelector('.mobileMenu');
    const menuButton = document.querySelector('.buttonDown');

    // Toggle mobile menu
    menuButton.addEventListener('click', function() {
        if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
            navbar.classList.add('fade-in');
            navbar.classList.remove('fade-out');
        } else {
            mobileMenu.classList.add('hidden');
        }
    });

    window.addEventListener('scroll', function() {
        let st = window.pageYOffset || document.documentElement.scrollTop;
        // Jika mobile menu aktif, jangan fade out
        if (!mobileMenu.classList.contains('hidden')) {
            navbar.classList.add('fade-in');
            navbar.classList.remove('fade-out');
            return;
        }
        if (st > lastScrollTop && st > 50) {
            // Scroll Down
            navbar.classList.add('fade-out');
            navbar.classList.remove('fade-in');
        } else {
            // Scroll Up
            navbar.classList.remove('fade-out');
            navbar.classList.add('fade-in');
        }
        lastScrollTop = st <= 0 ? 0 : st;
    }, false);
    // Initial state
    navbar.classList.add('fade-in');
</script>
</div>
