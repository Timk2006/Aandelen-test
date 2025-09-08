<script setup>
import { defineProps } from 'vue';
import NavBar from '../Components/NavBar.vue';

const props = defineProps({
  balance: Number,
  csrfToken: String 
});
</script>


<template>
  <nav class="navbar navbar-dark bg-primary flex-row z-index-3">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <ul class="navbar-nav me-auto mb-4 mb-lg-4 d-flex flex-row">
        <li class="nav-item">
          <a class="nav-link me-4" href="/dashboard">Home</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="/Aandelen">Aandelen</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="/Contact">Contact</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link opacity-100" href="/etf">Etf</a>
        </li>
        <li class="nav-item me-4 opacity-100">
          <a class="nav-link" href="/wallet">wallet</a>
        </li>
      <a class="navbar-brand me-4 opacity-100" href="/">Mijn porffolio</a>
      </ul>
    </div>
  </nav>

  <div class="container mt-4">
    <h2>Je saldo: €{{ props.balance.toFixed(2) }}</h2>

    <form method="POST" action="/wallet" class="mt-3">
      <input type="hidden" name="_token" :value="props.csrfToken" />
      <div class="mb-3">
        <label for="amount" class="form-label">Voeg geld toe:</label>
        <input type="number" name="amount" step="0.01" min="0.01" required class="form-control" />
      </div>
      <button type="submit" class="btn btn-primary">Toevoegen</button>
    </form>

    <a href="/etf" class="btn btn-outline-primary mt-4">Koop ETF's met je saldo</a>
  </div>
</template>
