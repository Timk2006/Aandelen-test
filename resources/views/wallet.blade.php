<h2>Je saldo: €{{ number_format($balance, 2) }}</h2>

<form method="POST" action="/wallet">
    @csrf
    <input type="number" name="amount" step="0.01" min="0.01" required>
    <button type="submit">Voeg geld toe</button>
</form>
