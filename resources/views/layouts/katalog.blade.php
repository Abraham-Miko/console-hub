<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Search')</title>

    <!-- Tailwind CDN (play) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.css" />

    <style>
        /* kecilkan container agar mirip layout gambar */
        .max-content-width { max-width: 1100px; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">

    <div class="min-h-screen flex justify-center py-10">
        <div class="w-full max-content-width px-4">
            @yield('content')
        </div>
    </div>

    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.js"></script>
</body>
</html>

@extends('layouts.katalog-design')

@section('title', 'Search Cars')

@section('content')
<div class="bg-white rounded-lg p-6 shadow-md mb-6">
    <!-- top search bar -->
    <div class="bg-lime-400 rounded-lg p-4">
        <form class="flex gap-4 items-center">
            <div class="flex-1 flex gap-4 items-center">
                <div class="bg-white rounded-md px-4 py-2 w-48 text-sm flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 19h14"></path></svg>
                    <div>
                        <div class="text-xs text-slate-500">Pick-up date</div>
                        <div class="text-sm font-semibold">Thu, 6 Nov 2025</div>
                    </div>
                </div>

                <div class="bg-white rounded-md px-4 py-2 w-48 text-sm flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 19h14"></path></svg>
                    <div>
                        <div class="text-xs text-slate-500">Drop-off date</div>
                        <div class="text-sm font-semibold">Sun, 9 Nov 2025</div>
                    </div>
                </div>
            </div>
            <button class="bg-sky-500 text-white px-6 py-2 rounded-md font-semibold">SEARCH</button>
        </form>
    </div>
</div>

<div class="grid grid-cols-12 gap-6">
    <!-- left filter column -->
    <aside class="col-span-3">
        <div class="bg-white rounded-lg shadow p-4 space-y-6">
            <div class="space-y-2">
                <label class="flex items-center gap-2"><input type="checkbox" class="form-checkbox"> Fuel Tank Full</label>
                <label class="flex items-center gap-2"><input type="checkbox" class="form-checkbox"> Unlimited Mileage</label>
                <label class="flex items-center gap-2"><input type="checkbox" class="form-checkbox"> Free Cancellation</label>
            </div>

            <hr>

            <div>
                <h6 class="font-semibold mb-2">Price</h6>
                <label class="flex items-center gap-2"><input type="checkbox"> Rp 0 - 1.000.000,00</label>
                <label class="flex items-center gap-2"><input type="checkbox"> Rp 1.000.001 - 5.000.000,00</label>
                <label class="flex items-center gap-2"><input type="checkbox"> Rp 5.000.001 - 10.000.000,00</label>
                <label class="flex items-center gap-2"><input type="checkbox" checked> Rp 10.000.000,00 &gt;</label>
            </div>

            <hr>

            <div>
                <h6 class="font-semibold mb-2">Person</h6>
                <label class="flex items-center gap-2"><input type="checkbox"> 1-2</label>
                <label class="flex items-center gap-2"><input type="checkbox"> 3-5</label>
                <label class="flex items-center gap-2"><input type="checkbox"> 5 &gt;</label>
            </div>

            <hr>

            <div>
                <h6 class="font-semibold mb-2">Bag</h6>
                <label class="flex items-center gap-2"><input type="checkbox"> 1-2</label>
                <label class="flex items-center gap-2"><input type="checkbox"> 3-5</label>
                <label class="flex items-center gap-2"><input type="checkbox"> 5 &gt;</label>
            </div>

            <hr>

            <div>
                <label class="flex items-center gap-2"><input type="checkbox"> AC</label>
                <label class="flex items-center gap-2"><input type="checkbox"> Non-AC</label>
            </div>
        </div>
    </aside>

    <!-- right results column -->
    <main class="col-span-9">
        <div class="flex items-center justify-between mb-4">
            <div class="text-sm text-slate-500">Showing 1 to 5 of 20 results</div>
            <div class="bg-white rounded-md p-2 shadow flex items-center gap-2">
                <span class="text-slate-500 mr-2">Sort by:</span>
                <select class="text-sm">
                    <option>Price: low to high</option>
                    <option>Price: high to low</option>
                </select>
            </div>
        </div>

        <div class="space-y-6">
            @foreach($cars as $car)
            <div class="bg-white rounded-lg shadow p-4 flex gap-6 items-center">
                <div class="w-44">
                    <img src="{{ asset($car['image']) }}" alt="{{ $car['title'] }}" class="rounded-md object-cover w-full h-28">
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="font-semibold text-lg">{{ $car['title'] }}</h3>
                            <div class="text-sm text-slate-500">{{ $car['transmission'] }}</div>
                        </div>

                        <div class="text-right">
                            <span class="inline-block text-xs px-3 py-1 rounded-full text-white" style="background-color: {{ $car['status'] == 'Available' ? '#3b82f6' : '#ef4444' }}">{{ $car['status'] }}</span>
                        </div>
                    </div>

                    <div class="mt-3 text-sm text-slate-600 flex gap-6">
                        <div class="flex items-center gap-2"><svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>{{ $car['seats'] }}</div>
                        <div class="flex items-center gap-2"><svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>{{ $car['bags'] }} bags</div>
                        <div class="flex items-center gap-2">@if($car['ac']) AC @else Non-AC @endif</div>
                    </div>

                </div>

                <div class="w-56 text-right">
                    <div class="text-slate-400 text-sm line-through">Rp 25.000.000,00/day</div>
                    <div class="text-xl font-bold mt-1">{{ $car['price'] }}</div>
                    <div class="mt-4 flex flex-col gap-2">
                        <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-md text-center">See Details</a>
                        <a href="#" class="bg-lime-500 text-white px-4 py-2 rounded-md text-center">Rent Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </main>
</div>

@endsection
