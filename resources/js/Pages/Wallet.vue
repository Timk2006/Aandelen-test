<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';


const props = defineProps({
  balance: Number,
  csrfToken: String 
});
</script>


<template>
    <NavBar />
    <AppLayout title="Wallet">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                Wallet
            </h2>
        </template>

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
  </div>
    <a href="/etf" class="btn btn-outline-primary mt-4">Koop ETF's met je saldo</a>
    </AppLayout>
</template>
