<header class="flex flex-col md:flex-row justify-between items-center px-4 md:px-12 lg:px-20 py-4 bg-white shadow-sm w-full z-50 fixed top-0">
    
    {{-- Baris Utama (Logo & Tombol Hamburger) --}}
    <div class="flex justify-between items-center w-full md:w-auto">
        <div class="flex items-center">
            <img src="{{ asset('dlhLogo.png') }}" alt="DLH Logo" class="h-10 mr-2"> 
            <span class="text-xl font-semibold text-primary font-montserrat">Dinas Lingkungan Hidup</span>
        </div>

        {{-- Hamburger Button (Hanya tampil di Mobile) --}}
        <button class="md:hidden p-2" onclick="toggleMenu()">
            <svg class="w-6 h-6 text-dlh-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>

    {{-- Navigasi Desktop (Selalu Tampil) --}}
    <nav class="hidden md:flex items-center space-x-8 text-sm lg:text-base">
        <ul class="flex space-x-8">
            <li><a href="{{ route('home') }}" class="font-medium text-dlh-dark hover:text-primary @if(request()->is('/')) font-semibold border-b-2 border-primary pb-1 @endif">Home</a></li>
            <li><a href="{{ route('news.index') }}" class="font-medium text-dlh-dark hover:text-primary @if(request()->is('berita*')) font-semibold border-b-2 border-primary pb-1 @endif">Berita</a></li>
            <li><a href="{{ route('divisi.index') }}" class="font-medium text-dlh-dark hover:text-primary">Divisi</a></li>
            <li><a href="#" class="font-medium text-dlh-dark hover:text-primary">Feedback</a></li>
        </ul>
        <a href="{{ route('login') }}" class="bg-accent text-dlh-dark px-5 py-2 rounded-xl font-semibold hover:bg-opacity-80 transition-colors text-sm lg:text-base">Log In</a>
    </nav>
    
    {{-- Navigasi Mobile (Tampil ketika tombol ditekan) --}}
    <div id="mobile-menu" class="hidden w-full md:hidden pt-4 pb-2 border-t border-gray-100 mt-2">
        <ul class="flex flex-col space-y-2 text-base">
            <li><a href="{{ route('home') }}" class="block px-2 py-1 font-medium text-dlh-dark hover:text-primary hover:bg-gray-50 rounded @if(request()->is('/')) text-primary font-semibold @endif">Home</a></li>
            <li><a href="{{ route('news.index') }}" class="block px-2 py-1 font-medium text-dlh-dark hover:text-primary hover:bg-gray-50 rounded @if(request()->is('berita*')) text-primary font-semibold @endif">Berita</a></li>
            <li><a href="#" class="block px-2 py-1 font-medium text-dlh-dark hover:text-primary hover:bg-gray-50 rounded">Divisi</a></li>
            <li><a href="#" class="block px-2 py-1 font-medium text-dlh-dark hover:text-primary hover:bg-gray-50 rounded">Feedback</a></li>
        </ul>
        <a href="{{ route('login') }}" class="block mt-4 text-center bg-accent text-dlh-dark px-5 py-2 rounded-xl font-semibold hover:bg-opacity-80 transition-colors">Log In</a>
    </div>

</header>