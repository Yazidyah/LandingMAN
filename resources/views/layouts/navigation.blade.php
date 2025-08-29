@php
    $userRole = Auth::user()->role;
    $redirectUrl = 'dashboard';

    switch ($userRole) {
        //Admin
        case 'admin':
            $redirectUrl = 'admin.dashboard';
            $redirectUrlp = 'admin.persyaratan';
            $redirectUrlk = 'admin.alur-pendaftaran';
            $redirectUrlpk = 'admin.data-afirmasi-prestasi';
            $redirectUrlc = 'admin.data-afirmasi-abk';
            $redirectUrlrr = 'admin.data-afirmasi-ketm';
            $redirectUrldk = 'admin.data-tidaklulus';
            $redirectUrlst = 'admin.data-reguler';
            $redirectUrls = 'admin.dashboard';
            $redirectUrlls = 'admin.dashboard';
            $redirectUrstep1 = 'admin.dashboard';
            $redirectUrstep2 = 'admin.dashboard';
            $redirectUrlsyarat = 'admin.dashboard';
            $redirectUrljalur = 'admin.dashboard';
            $redirectUrlpot = 'pekerjaan-ortu.index';
            $redirectUrltes = 'admin.dashboard';
            $redirectUrlcat = 'admin.categories';
            break;

        default:
            $redirectUrl = 'admin.dashboard';
            $redirectUrlp = 'admin.dashboard';
            $redirectUrlk = 'admin.dashboard';
            $redirectUrlpk = 'admin.dashboard';
            $redirectUrlc = 'admin.dashboard';
            $redirectUrlrr = 'admin.dashboard';
            $redirectUrldk = 'admin.dashboard';
            $redirectUrlst = 'admin.dashboard';
            $redirectUrls = 'admin.dashboard';
            $redirectUrlbar = 'admin.banner.index';
            $redirectUrlps = 'admin.profilsekolah';
            $redirectUrlnews = 'admin.news';
            $redirectUrlfas = 'admin.fasilitas';
            $redirectUrlpres = 'admin.prestasi';
            $redirectUrlfaq = 'admin.faq.index';
            $redirectUrlagenda = 'admin.agenda';
            $redirectUrlpub = 'admin.publikasi';
            $redirectUrlkritsar = 'admin.kritiksaran.index';
            $redirectUrlvisi = 'admin.visimisi.index';
            $redirectUrlsej = 'admin.sejarah.index';
            $redirectUrlcat = 'admin.categories.index';
            $redirectUrlcont = 'admin.contents.index';
            $redirectUrlikm = 'admin.ikm.index';
            $redirectUrlkue = 'admin.kuesioner.index';
            $redirectUrlresp = 'admin.responden.index';
            $redirectUrlsurv = 'admin.survey.index';
            $redirectUrlunsur = 'admin.unsur.index';
            $redirectUrlpres = 'admin.prestasi.index';
            $redirectUrluser = 'admin.users.index';
            break;

    }
@endphp




<nav x-data="{ open: false }" class="fixed top-0 z-50 bg-tertiary mx-auto w-full right-0 left-0">
    <!-- Primary Navigation Menu -->
    <div class="flex justify-between items-center container mx-auto">


        <!-- Logo -->
        <div x-data="{cheat:false}" class="flex items-center gap-1 justify-center px-6">
            <a href={{ route($redirectUrl) }}>
                <x-application-logo class=" h-9 w-auto fill-current text-gray-800 " />
            </a>
        </div>
        <div class="flex">
            <!-- Navigation Links -->
            <div class="items-center justify-center flex">
                <div class=" text-white text-xs xl:text-base font-semibold lg:flex gap-4 hidden">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <div class="border-l py-3"></div>
                </div>
            </div>


            <!-- Settings Dropdown -->
            <div class="py-4 px-6 lg:flex hidden gap-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class=" hover:text-tertiary inline-flex items-center  border border-transparent  leading-4 bg-dasar  focus:outline-none transition ease-in-out duration-150 hover:bg-white
                        text-white outline-dasar outline px-7 py-3 rounded-full font-bold text-xs xl:text-base hover:text-dasar2 ">
                            <img src="/logoman.webp" class="w-5 mr-2">
                            <div class="" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 " xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="py-4 px-6 lg:hidden block text-white content">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-dasar  focus:outline-none 0  focus:text-dasar  transition duration-150 ease-in-out">
                    <svg width="35" height="35" viewBox="0 0 448 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"
                            fill="white" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class=" hidden lg:hidden h-64 overflow-y-auto">
        <div class=" pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-dasar">
            <div class="px-4">
                <div class="font-medium text-base text-white"
                    x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                    x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-300">{{ auth()->user()->email }}</div>
            </div>

            <div class=" mt-3">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>
</nav>
<aside x-show="cheat" id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-tertiary">
        <ul class="space-y-2 font-medium">
            <!-- <li>
            <x-side-nav :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
            {{ __('Home') }}
            </x-side-nav>
        </li>
        <li>
            <x-side-nav :href="route($redirectUrlbar)" :active="request()->routeIs($redirectUrlbar)">
            {{ __('Carrousel Banner') }}
            </x-side-nav>
        </li>
        <li>
            <x-side-nav :href="route($redirectUrlps)" :active="request()->routeIs($redirectUrlps)">
            {{ __('Profil Sekolah') }}
            </x-side-nav>
        </li>
        <li>
            <x-side-nav :href="route($redirectUrlnews)" :active="request()->routeIs($redirectUrlnews)">
            {{ __('Berita Sekolah') }}
            </x-side-nav>
        </li>
        <li>
            <x-side-nav :href="route($redirectUrlfas)" :active="request()->routeIs($redirectUrlfas)">
            {{ __('Fasilitas') }}
            </x-side-nav>
        </li>
        <li>
            <x-side-nav :href="route($redirectUrlpres)" :active="request()->routeIs($redirectUrlpres)">
            {{ __('Prestasi') }}
            </x-side-nav>
        </li>
        <li>
            <x-side-nav :href="route($redirectUrlagenda)" :active="request()->routeIs($redirectUrlagenda)">
            {{ __('Agenda Kegiatan') }}
            </x-side-nav>
        </li>
        <li>
            <x-side-nav :href="route($redirectUrlpub)" :active="request()->routeIs($redirectUrlpub)">
            {{ __('Publikasi') }}
            </x-side-nav>
        </li> --->
            <li>
                <x-side-nav :href="route($redirectUrlbar)" :active="request()->routeIs($redirectUrlbar)">
                    {{ __('Banner') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlfaq)" :active="request()->routeIs($redirectUrlfaq)">
                    {{ __('FAQ') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlvisi)" :active="request()->routeIs($redirectUrlvisi)">
                    {{ __('Visi Misi') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlsej)" :active="request()->routeIs($redirectUrlsej)">
                    {{ __('Sejarah') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlcat)" :active="request()->routeIs($redirectUrlcat)">
                    {{ __('Kategori') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlcont)" :active="request()->routeIs($redirectUrlcont)">
                    {{ __('Konten') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlikm)" :active="request()->routeIs($redirectUrlikm)">
                    {{ __('Indeks Kepuasan Masyarakat') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlsurv)" :active="request()->routeIs($redirectUrlsurv)">
                    {{ __('Survey') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlunsur)" :active="request()->routeIs($redirectUrlunsur)">
                    {{ __('Unsur') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlkue)" :active="request()->routeIs($redirectUrlkue)">
                    {{ __('Kuesioner') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlresp)" :active="request()->routeIs($redirectUrlresp)">
                    {{ __('Responden') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlpres)" :active="request()->routeIs($redirectUrlpres)">
                    {{ __('Prestasi') }}
                </x-side-nav>
            </li>
            <li>
                <x-side-nav :href="route($redirectUrlkritsar)" :active="request()->routeIs($redirectUrlkritsar)">
                    {{ __('Kritik & Saran') }}
                </x-side-nav>
            </li>
            @if(auth()->user()->name === 'superadmin')
            <li>
                <x-side-nav :href="route($redirectUrluser)" :active="request()->routeIs($redirectUrluser)">
                    {{ __('Admin') }}
                </x-side-nav>
            </li>
            @endif
        </ul>
    </div>
</aside>

<main>
    @yield('content')
</main>
@livewireScripts
<script>
    window.setTab = function (tab) {
        // Hilangkan kelas aktif dari semua tombol tab
        document.querySelectorAll('button[onclick^="setTab"]').forEach(button => {
            button.classList.remove('text-indigo-700', 'border-indigo-500');
            button.classList.add('text-gray-400', 'border-white');
        });

        // Tambahkan kelas aktif pada tombol yang dipilih
        const activeButton = document.querySelector(`button[onclick="setTab('${tab}')"]`);
        if (activeButton) {
            activeButton.classList.add('text-indigo-700', 'border-indigo-500');
            activeButton.classList.remove('text-gray-400', 'border-white');
        }

        // Sembunyikan semua konten tab
        document.querySelectorAll('.tab-content').forEach(content => {
            content.style.display = 'none';
        });

        // Tampilkan konten tab yang aktif
        document.getElementById(`${tab}-content`).style.display = 'block';
    }
</script>
</body>

</html>