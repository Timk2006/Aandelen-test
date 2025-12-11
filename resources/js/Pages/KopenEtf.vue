<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import NavBar from '@/Components/NavBar.vue'

const props = defineProps({
  etfs: Array,
  sort: String,
  direction: String
})

const etfForm = useForm({
  etf_id: '',
  aantal: 1,
  prijs_per_stuk: 0,
})

function submitEtf() {
  const geselecteerd = props.etfs.find(e => e.id === etfForm.etf_id)
  etfForm.prijs_per_stuk = geselecteerd ? geselecteerd.prijs : 0
  etfForm.post(route('etf.buy'), { onSuccess: () => etfForm.reset() })
}
</script>

<template>
  <NavBar />
  <AppLayout title="ETF Kopen">

    <h1 class="text-xl font-bold mb-4">Koop ETF</h1>
    <form @submit.prevent="submitEtf" class="space-y-4">
      <select v-model="etfForm.etf_id" class="w-full border rounded p-2">
        <option disabled value="">Selecteer ETF</option>
        <option v-for="e in props.etfs" :key="e.id" :value="e.id">
          {{ e.naam }} (€{{ Number(e.prijs).toFixed(2) }})
        </option>
      </select>
      <input v-model="etfForm.aantal" type="number" min="1" class="w-full border rounded p-2" />
      <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
        Koop ETF
      </button>
    </form>
    
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
