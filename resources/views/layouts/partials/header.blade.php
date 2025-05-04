<header class="js-page-header fixed top-0 z-20 w-full backdrop-blur transition-colors">
    <div class="flex items-center py-6 gap-4 xl:mx-60 lg:mx-40 mx-5 flex-col lg:flex-row">
        <a href="" class="flex items-center gap-2">
            <h1 class="dark:text-white font-bold text-3xl">Manajemen Tutorial</h1>
        </a>

        <!-- Menu / Actions -->
        <div
            class="js-mobile-menu inset-0 z-10 ml-auto sm:ml-0 xl:ml-auto items-center dark:bg-jacarta-800 lg:relative lg:inset-auto lg:flex lg:bg-transparent lg:opacity-100 dark:lg:bg-transparent">
            <!-- Primary Nav -->
            <nav class="navbar w-full">
                <ul class="flex justify-start lg:gap-6  gap-5 flex-col sm:flex-row-reverse  sm:items-center items-end">
                    <li class="group flex items-center justify-center ">
                        <form action="{{ route('logout') }}" method="POST"
                            onsubmit="return confirm('Yakin mau logout?')">
                            @csrf
                            <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 flex items-center gap-2">
                                <x-heroicon-o-arrow-left-start-on-rectangle class="w-6 h-6" />
                            </button>
                        </form>
                    </li>
                    <li class="group flex items-center justify-center ">
                        <a href="{{ route('tutorials.index') }}"
                            class="bg-button text-white px-4 py-2 rounded-lg inline-block hover:bg-button-hover">
                            <x-heroicon-o-home class="w-6 h-6" />
                        </a>
                    </li>
                    <li class="group">
                        <a href="{{ route('tutorials.create') }}"
                            class="bg-button text-white px-4 py-2 rounded-lg inline-block hover:bg-button-hover">+
                            Tambah Tutorial
                        </a>
                    </li>
                    <li class="group">
                        <div class="relative flex items-center">
                            <input type="text"
                                class="border-1 border-button rounded-lg px-6 py-2 focus:outline-none focus:ring-2 focus:ring-button"
                                placeholder="Cari...">
                            <button class="absolute right-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 text-gray-500 hover:text-button">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
                                </svg>
                            </button>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
