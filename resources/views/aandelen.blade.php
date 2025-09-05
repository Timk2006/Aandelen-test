<<form method="POST" action="{{ route('aandelen.koop') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @csrf
    <select name="aandeel_id">
        @foreach($aandeel as $aandeel)
            <option value="{{ $aandeel->id }}">{{ $aandeel->naam }} (€{{ $aandeel->prijs }})</option>
        @endforeach
    </select>

    <input type="number" name="aantal" min="1" placeholder="Aantal aandelen">
    <button type="submit">Koop</button>
</form>

