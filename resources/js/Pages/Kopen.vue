<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';


const props = defineProps({ 
  aandelen: Array,
  etfs: Array
})

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

function submitAandeel() {
  const geselecteerd = props.aandelen.find(a => a.id === aandeelForm.aandeel_id)
  aandeelForm.prijs_per_stuk = geselecteerd ? geselecteerd.prijs : 0
  aandeelForm.post(route('kopen'), { onSuccess: () => aandeelForm.reset() })
}

function submitEtf() {
  const geselecteerd = props.etfs.find(e => e.id === etfForm.etf_id)
  etfForm.prijs_per_stuk = geselecteerd ? geselecteerd.prijs : 0
  etfForm.post(route('Etfkopen'), { onSuccess: () => etfForm.reset() })
}

</script>

<template>
  <NavBar />
  <AppLayout title="Wallet">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-900 leading-tight">
        Wallet
      </h2>
    </template>

    
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
          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Koop aandeel</button>
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
  </AppLayout>
</template>
