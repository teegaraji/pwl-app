<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class=" text-gray-100 bg-gray-900 flex justify-center ">
    <div class="container mx-80 ">
        <div class="h-lvh flex items-center justify-center  px-4 sm:px-6">
            <div class="terminal font-mono w-full max-w-md sm:max-w-lg">
                <div class="terminal-header bg-zinc-700 text-white p-2 rounded-t-lg flex items-center">
                    <span class="text-red-500 text-4xl sm:text-5xl leading-[0px] align-middle -mt-2">•</span>
                    <span class="text-yellow-500 text-4xl sm:text-5xl leading-[0px] align-middle -mt-2 ml-1">•</span>
                    <span class="text-green-500 text-4xl sm:text-5xl leading-[0px] align-middle -mt-2 ml-1">•</span>
                    <span class="ml-2 sm:ml-4 text-sm sm:text-base align-baseline truncate">authentication --- bash -
                        zsh</span>
                </div>
                <div class="p-3 sm:p-4 bg-gray-800 rounded-b-lg">
                    <p class="text-gray-500 text-sm sm:text-base mb-3 sm:mb-4">You need to authenticate to continue!</p>
                    <p class="text-sky-300 text-sm sm:text-base mb-4 sm:mb-6">Enter credentials to login:</p>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <div class="flex items-center mb-1 sm:mb-0 sm:min-w-[100px]">
                                    <span class="text-green-500">➝</span>
                                    <span class="text-sky-300 ml-2 w-20 ">email</span>
                                    <span class="text-sky-300 ">:</span>
                                </div>
                                <input type="email" name="email" id="email"
                                    class="bg-transparent border-none outline-none ring-0 pl-1 focus:ring-0 text-amber-400 w-full sm:flex-1 @error('email') border-red-500 @enderror"
                                    value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs sm:text-sm ml-5 sm:ml-[100px] mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="flex flex-col sm:flex-row sm:items-center">
                                <div class="flex items-center mb-1 sm:mb-0 sm:min-w-[100px]">
                                    <span class="text-green-500">➝</span>
                                    <span class="text-sky-300 ml-2 w-20">password</span>
                                    <span class="text-sky-300 ">:</span>
                                </div>
                                <input type="password" name="password" id="password"
                                    class="bg-transparent border-none outline-none ring-0 pl-1 focus:ring-0 text-amber-400 w-full sm:flex-1"
                                    required>
                            </div>
                        </div>

                        <div class="mt-6 sm:mt-8">
                            <button type="submit"
                                class="bg-gray-800 border border-gray-600 text-green-400 px-3 sm:px-4 py-1.5 sm:py-2 text-sm sm:text-base rounded hover:bg-gray-700 transition-colors">
                                Execute Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
