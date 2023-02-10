<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Trains</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/js/app.js')

</head>

<body class="bg-success">

    <main class="p-3">
        <h1 class="text-center text-light">Trains</h1>
        <div class="row g-3">
            @foreach ($trains as $train)
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    <div class="card p-2">
                        <h3>{{ $train->departure_station }} - {{ $train->arrival_station }}</h3>
                        <div class="text-primary">{{ $train->company }}</div>
                        <div>Departure: {{ $train->departure_date_time }}</div>
                        <div>Arrive: {{ $train->arrival_date_time }}</div>
                        <div>TC: {{ $train->train_code }}</div>
                        <div>Wagon: {{ $train->n_compartment }}</div>
                        {{-- ho sbagliato sulla tabella dovevo mettere is_cancelled --}}
                        <div class="{{ ($train->is_delayed) ? 'text-danger' : (($train->on_schedule) ? 'text-success' : 'text-warning') }}"
                        >Status: {{ ($train->is_delayed) ? 'cancelled' : (($train->on_schedule) ? 'on schedule' : 'delayed') }}</div>
                    </div>  
                </div>
            @endforeach
        </div>
    </main>

</body>

</html>
