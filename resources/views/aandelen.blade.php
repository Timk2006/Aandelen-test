<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Aandelen Beheer</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body>

<h1>Aandelen Kopen</h1>

<!-- BESTAANDE KOOP-FORMULE -->
<form method="POST" action="{{ route('aandelen.koop') }}">
    @csrf

    <select name="aandeel_id">
        @foreach($aandeel as $a)
            <option value="{{ $a->id }}">{{ $a->naam }} (€{{ $a->prijs }})</option>
        @endforeach
    </select>

    <input type="number" name="aantal" min="1" placeholder="Aantal aandelen">
    <button type="submit">Koop</button>
</form>

<hr>

<h1>Nieuw Aandeel Toevoegen</h1>

<!-- TOEVOEGEN -->
<form method="POST" action="/aandelen/add">
    @csrf
    <input name="naam" placeholder="Naam aandeel">
    <input name="prijs" type="number" step="0.01" placeholder="Prijs">
    <button type="submit">Toevoegen</button>
</form>

<hr>

<h1>Aandelen Lijst (Verwijderen)</h1>

<!-- VERWIJDEREN -->
@foreach($aandeel as $a)
    <div style="margin-bottom: 10px;">
        {{ $a->naam }} (€{{ $a->prijs }})

        <form method="POST" action="/aandelen/{{ $a->id }}" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Verwijderen</button>
        </form>
    </div>
@endforeach

</body>
</html>
