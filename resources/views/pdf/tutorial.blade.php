<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="10">

    <title>{{ $tutorial->title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- js --}}
    <script src="{{ asset('js/darkmode.js') }}"></script>
</head>

<body class="text-secondary bg-primary flex justify-center">
    <div class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-6">{{ $tutorial->title }}</h1>

        @forelse ($details as $detail)
            <div class="mb-8 pb-6 break-words">
                <h1 class="text-2xl font-bold">{{ $detail->order }}</h1>

                @if ($detail->text)
                    <p class="text-lg mb-4">
                        {!! nl2br(
                            preg_replace(
                                '/(https?:\/\/[^\s]+)/',
                                '<a href="$1" target="_blank" class="text-blue-500 underline">$1</a>',
                                e($detail->text),
                            ),
                        ) !!}
                    </p>
                @endif

                @if ($detail->image)
                    <img src="data:image/png;base64,{{ $detail->image }}" alt="Gambar" class="w-full mb-4 rounded">
                @endif

                @if ($detail->code)
                    <pre class="bg-gray-800 text-white p-4 rounded overflow-x-auto"><code>{{ $detail->code }}</code></pre>
                @endif

                @if ($detail->url)
                    <a href="{{ $detail->url }}" target="_blank"
                        class="text-blue-500 underline">{{ $detail->url }}</a>
                @endif
            </div>
        @empty
            <p class="text-gray-600">Belum ada detail tutorial yang terbuka.</p>
        @endforelse
    </div>

</body>

</html>
