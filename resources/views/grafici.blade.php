<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>

    <div>

        <div class="container mt-5 justify-content-center d-flex">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="card" style="width: 30rem; height: 15rem;">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h3 class="card-title mt-4">Prenotazioni totali oggi</h3>
                            <h1 class="card-subtitle my-4" id="prenotazioniOggi">{{ $prenotazioniTotaliOggi }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <div class="card" style="width: 30rem; height: 15rem;">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h3 class="card-title text-center">Seleziona campo</h3>
                            <select class="form-control mt-4 text-center" style="width: 70%;" id="campoSelect" onchange=`ChangeCampo()`>
                                <option value="0" selected>Seleziona un campo</option>
                                @foreach ($campi as $campo)
                                    <option value={{$campo->id}}>{{$campo->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    <div class="d-flex container-fluid flex-wrap justify-content-center">
        <div style="width: 900px; margin-top: 50px"  >
            <h3>Ultimi 12 mesi</h3>
            <canvas id="Year"></canvas>
            <script>
                let arrYear = @json($arrYear);
            </script> 
        </div>
        <div style="width: 900px; margin-top: 50px" >
            <h3>Questo Mese</h3>
            <canvas id="Mounth"></canvas>
            <script>
                let arrMonth = @json($arrMonth);
            </script> 
        </div>
    </div>
    <div style="width: 900px; margin: auto; margin-top: 50px" class="mb-5">
        <h3>Questa Settimana</h3>
        <canvas id="Week"></canvas>
        <script>
            let arrWeek = @json($arrWeek);
        </script> 
    </div>

</body>

</html>
