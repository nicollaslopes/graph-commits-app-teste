<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                @foreach($repos as $repo)
                <a href="{{ route('graphs', $repo) }}">{{ $repo }}</a>
                <br>
                @endforeach
                <body>
                    <canvas id="myChart" width="400" height="400"></canvas>
                </body>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

