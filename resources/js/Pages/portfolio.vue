<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
  wallet_balance: [Number, String],
  totaal_portefeuille: [Number, String],
  aandelen: Array,
  etfs: Array,
})
</script>

<template>
  <AppLayout title="Portfolio">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-900 leading-tight">
        Portfolio
      </h2>
    </template>

    <div class="p-4 space-y-6">
      <div>
        <h1 class="text-2xl font-bold">Mijn Portefeuille</h1>
        <p>
          Wallet Balance: €
          {{ Number(props.wallet_balance).toFixed(2) }}
        </p>
        <p>
          Totaal Portefeuille: €
          {{ Number(props.totaal_portefeuille).toFixed(2) }}
        </p>
      </div>

      <div>
        <h2 class="text-xl font-semibold">Aandelen</h2>
        <ul class="list-disc list-inside">
          <li v-for="aandeel in props.aandelen" :key="aandeel.id">
            {{ aandeel.naam }} – {{ aandeel.pivot.aantal }} stuks –
            Totaal: €{{ Number(aandeel.totaal).toFixed(2) }}
          </li>
          <li v-if="props.aandelen.length === 0">
            Je hebt nog geen aandelen.
          </li>
        </ul>
      </div>

      <div>
        <h2 class="text-xl font-semibold">ETF's</h2>
        <ul class="list-disc list-inside">
          <li v-for="etf in props.etfs" :key="etf.id">
            {{ etf.naam }} – {{ etf.pivot.aantal }} stuks –
            Totaal: €{{ Number(etf.totaal).toFixed(2) }}
          </li>
          <li v-if="props.etfs.length === 0">
            Je hebt nog geen ETF's.
          </li>
        </ul>
      </div>
    </div>

<footer class="bg-gray-900 text-gray-300 py-6 w-full-mt-12">
  <div class="mx-auto px-4 flex flex-col md:flex-row justify-between items-center max-w-screen-xl">
    <p class="text-sm">&copy; 2025 Aandelen website, Alle rechten voorbehouden prive.</p>
    <div class="flex space-x-6 mt-4 md:mt-0">
      <a href="bot" class="hover:text-white transition">Ai bot</a>
      <a href="aandelen" class="hover:text-white transition">Aandelen</a>
      <a href="etf" class="hover:text-white transition">Etf</a>
    </div>
  </div>
</footer>

  </AppLayout>
</template>
