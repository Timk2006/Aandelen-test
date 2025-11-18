<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import NavBar from '@/Components/NavBar.vue'
import { onMounted, nextTick } from 'vue'
import { Chart, registerables } from 'chart.js'
Chart.register(...registerables)

// ✅ Props met standaard lege arrays (voorkomt undefined errors)
const props = defineProps({
  aandelen: { type: Array, default: () => [] },
  etfs: { type: Array, default: () => [] }
})

// ✅ Formulieren voor aandelen en ETF’s
const aandeelForm = useForm({
  aandeel_id: '',
  aantal: 1,
  prijs_per_stuk: 0,
})

const etfForm = useForm({
  etf_id: '',
  aantal: 1,
  prijs_per_stuk: 0,
})

// ✅ Koop-functie voor aandelen
function submitAandeel() {
  const geselecteerd = props.aandelen.find(a => a.id === aandeelForm.aandeel_id)
  aandeelForm.prijs_per_stuk = geselecteerd ? geselecteerd.prijs : 0
  aandeelForm.post(route('kopen'), { onSuccess: () => aandeelForm.reset() })
}

// ✅ Koop-functie voor ETF’s
function submitEtf() {
  const geselecteerd = props.etfs.find(e => e.id === etfForm.etf_id)
  etfForm.prijs_per_stuk = geselecteerd ? geselecteerd.prijs : 0
  etfForm.post(route('Etfkopen'), { onSuccess: () => etfForm.reset() })
}

// ✅ Functie om grafieken te tekenen
function renderCharts(items, prefix) {
  if (!Array.isArray(items) || items.length === 0) {
    console.warn(`Geen ${prefix}-data beschikbaar om te tekenen.`)
    return
  }

  items.forEach((item) => {
    const ctx = document.getElementById(`${prefix}-${item.id}`)
    if (!ctx || !item.fake_prices) return

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: item.fake_prices.map(p => p.datum),
        datasets: [
          {
            label: item.naam,
            data: item.fake_prices.map(p => p.prijs),
            borderWidth: 2,
            borderColor: prefix === 'aandeel' ? 'rgb(54, 162, 235)' : 'rgb(255, 159, 64)',
            tension: 0.3,
            fill: false,
          }
        ]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: false } }
      }
    })
  })
}

// ✅ Render grafieken zodra component is geladen
onMounted(async () => {
  await nextTick() // wacht tot DOM volledig is geladen
  renderCharts(props.aandelen, 'aandeel')
  renderCharts(props.etfs, 'etf')
})
</script>

<template>
  <NavBar />

  <AppLayout title="Wallet">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-900 leading-tight">
        Wallet
      </h2>
    </template>

    <!-- Koop aandelen -->
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow grid grid-cols-1 md:grid-cols-2 gap-8">
      <div>
        <h1 class="text-xl font-bold mb-4">Koop aandelen</h1>
        <form @submit.prevent="submitAandeel" class="space-y-4">
          <select v-model="aandeelForm.aandeel_id" class="w-full border rounded p-2">
            <option disabled value="">Selecteer aandeel</option>
            <option v-for="a in props.aandelen" :key="a.id" :value="a.id">
              {{ a.naam }} (€{{ Number(a.prijs).toFixed(2) }})
            </option>
          </select>
          <input v-model="aandeelForm.aantal" type="number" min="1" class="w-full border rounded p-2" />
          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Koop aandeel
          </button>
        </form>

        <div v-if="Object.keys(aandeelForm.errors).length" class="mt-4 text-red-600">
          <div v-for="(msg, key) in aandeelForm.errors" :key="key">{{ msg }}</div>
        </div>

        <div v-if="$page.props.flash?.success" class="mt-4 text-green-600">
          {{ $page.props.flash.success }}
        </div>

        <div v-if="aandeelForm.errors.saldo" class="mt-4 text-red-600">
          {{ aandeelForm.errors.saldo }}
        </div>
      </div>
    </div>

    <!-- Grafieken voor aandelen -->
    <div class="max-w-6xl mx-auto mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
      <div v-for="aandeel in props.aandelen" :key="aandeel.id" class="border rounded-lg shadow p-4">
        <h2 class="font-semibold text-lg mb-2">{{ aandeel.naam }}</h2>
        <canvas :id="`aandeel-${aandeel.id}`" height="150"></canvas>
      </div>
    </div>

    <!-- Grafieken voor ETF’s -->
    <div v-if="props.etfs.length" class="max-w-6xl mx-auto mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
      <div v-for="etf in props.etfs" :key="etf.id" class="border rounded-lg shadow p-4">
        <h2 class="font-semibold text-lg mb-2">{{ etf.naam }}</h2>
        <canvas :id="`etf-${etf.id}`" height="150"></canvas>
      </div>
    </div>

    <!-- Voettekst -->
    <footer class="bg-gray-900 text-gray-300 py-6 w-full mt-12">
      <div class="mx-auto px-4 flex flex-col md:flex-row justify-between items-center max-w-screen-xl">
        <p class="text-sm">&copy; 2025 Aandelen website, Alle rechten voorbehouden privé.</p>
        <div class="flex space-x-6 mt-4 md:mt-0">
          <a href="bot" class="hover:text-white transition">AI bot</a>
          <a href="aandelen" class="hover:text-white transition">Aandelen</a>
          <a href="etf" class="hover:text-white transition">ETF</a>
        </div>
      </div>
    </footer>

    <footer class="mt-6 text-center text-sm text-gray-500">
      Gemaakt door Tim Koops
    </footer>
  </AppLayout>
</template>

<style scoped>
canvas {
  width: 100% !important;
  height: 200px !important;
}
</style>
