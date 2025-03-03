<div class=" bg-primary mx-auto w-full sticky z-10 top-0 right-0 left-0">
    <!-- Navigation -->
    <nav class="flex justify-between items-center container mx-auto border-b-2 max-w-full border-b-white py-4">
        <a href="/" class=" flex items-center gap-4 justify-center px-6">
            <img class="w-10 " src="logoman.webp" alt="">
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
            <svg width="65" height="65" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M9.38297 55.6177C13.3534 59.5827 19.7342 59.5827 32.5013 59.5827C45.2684 59.5827 51.6519 59.5827 55.6169 55.615C59.5846 51.6527 59.5846 45.2664 59.5846 32.4994C59.5846 19.7323 59.5846 13.3487 55.6169 9.38102C51.6546 5.41602 45.2684 5.41602 32.5013 5.41602C19.7342 5.41602 13.3507 5.41602 9.38297 9.38102C5.41797 13.3514 5.41797 19.7323 5.41797 32.4994C5.41797 45.2664 5.41797 51.6527 9.38297 55.6177ZM50.7826 43.3327C50.7826 43.8714 50.5686 44.3881 50.1876 44.769C49.8067 45.1499 49.29 45.3639 48.7513 45.3639H16.2513C15.7126 45.3639 15.1959 45.1499 14.815 44.769C14.4341 44.3881 14.2201 43.8714 14.2201 43.3327C14.2201 42.794 14.4341 42.2773 14.815 41.8964C15.1959 41.5154 15.7126 41.3014 16.2513 41.3014H48.7513C49.29 41.3014 49.8067 41.5154 50.1876 41.8964C50.5686 42.2773 50.7826 42.794 50.7826 43.3327ZM48.7513 34.5306C49.29 34.5306 49.8067 34.3166 50.1876 33.9357C50.5686 33.5547 50.7826 33.0381 50.7826 32.4994C50.7826 31.9606 50.5686 31.444 50.1876 31.063C49.8067 30.6821 49.29 30.4681 48.7513 30.4681H16.2513C15.7126 30.4681 15.1959 30.6821 14.815 31.063C14.4341 31.444 14.2201 31.9606 14.2201 32.4994C14.2201 33.0381 14.4341 33.5547 14.815 33.9357C15.1959 34.3166 15.7126 34.5306 16.2513 34.5306H48.7513ZM50.7826 21.666C50.7826 22.2047 50.5686 22.7214 50.1876 23.1023C49.8067 23.4833 49.29 23.6973 48.7513 23.6973H16.2513C15.7126 23.6973 15.1959 23.4833 14.815 23.1023C14.4341 22.7214 14.2201 22.2047 14.2201 21.666C14.2201 21.1273 14.4341 20.6106 14.815 20.2297C15.1959 19.8488 15.7126 19.6348 16.2513 19.6348H48.7513C49.29 19.6348 49.8067 19.8488 50.1876 20.2297C50.5686 20.6106 50.7826 21.1273 50.7826 21.666Z"
                    fill="white" />
            </svg>
        </button>
    </nav>
    <div class="hidden items-center justify-center lg:flex lg:bg-gradient-to-b from-primary to-tertiary transition-colors">
            <div class=" h-14 items-center flex">
                <ul class="text-white text-xs xl:text-base font-semibold  lg:flex gap-4 hidden">
                    <li>
                        <x-side-nav :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                        </x-side-nav>
                    </li>
                    <li>
                    <div class="relative  items-center   text-sm font-medium leading-5 text-white focus:outline-none px-1 focus:border-indigo-700   hover:text-tertiary " x-data="{dropdown:false}">
                        <button @click="dropdown = !dropdown" class="inline-flex hover:bg-white focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg " >Profil Sekolah</button>
                        <!-- Dropdown -->
                        <div class="lg:absolute bg-secondary z-10 text-tertiary rounded-md right-0 my-2 p-2" x-show="dropdown" @click.outside="dropdown = false">
                            <ul class="space-y-2 w-48">
                                <li><a href="/sejarah" class="flex p-2 font-medium text-tertiary rounded-md hover:bg-white hover:text-tertiary">Sejarah</a></li>
                                <li><a href="/visimisi" class="flex p-2 font-medium text-tertiary rounded-md hover:bg-white hover:text-tertiary">Visi Misi</a></li>
                           </ul>
                        </div>
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
                        <x-side-nav :href="route('guest.saranpengaduan')" :active="request()->routeIs('guest.saranpengaduan')">
                        {{ __('Saran & Pengaduan') }}
                        </x-side-nav>
                    </li>
                    <li 
                        class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                        <a href="/ppdb">PPDB</a>
                    </li>
                    <li>
                        <x-side-nav :href="route('guest.publikasi')" :active="request()->routeIs('guest.publikasi')">
                        {{ __('Publikasi') }}
                        </x-side-nav>
                    </li>

                    
                </ul>
            </div>
            </div>
    <div class="mobileMenu hidden  lg:hidden">
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
                        <a href="{{ route('guest.saranpengaduan') }}">Saran & Pengaduan</a>
                    </li>
                    <li
                        class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                        <a href="/ppdb">PPDB</a>
                    </li>
                    <li
                        class="hover:bg-secondary hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg">
                        <a href="{{ route('guest.publikasi') }}">Publikasi</a>
                    </li>
        </ul>
        <div class=" flex gap-4 px-4 pb-4 mt-4">
            <a class="flex items-center justify-center w-full text-white outline px-9 py-4 rounded-full font-bold text-sm hover:bg-secondary hover:text-primary"
                href="login">Masuk</a>
        </div>
        <div class="py-4 px-3 cursor-pointer hover:bg-white text-white hover:text-primary focus-scale-95 transition-all duration-200 ease-out p-2 relative text-sm text-center font-bold"
            x-data="{ dropdown: false }">
            <button @click="dropdown = !dropdown"
                class=" focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg ">Daftar</button>
            <!--DropDown-->
            <div class=" bg-secondary z-10 text-primary rounded-md right-0 my-2 p-2" x-show="dropdown"
                @click.outside="dropdown = false">
                <ul class="space-y-2 w-full">
                    <li><a href="register"
                            class="flex p-2 font-medium text-primary rounded-md hover:bg-white hover:text-black">Anggota
                            Khalansa</a></li>

                </ul>
            </div>
        </div>
    </div>
</div>
