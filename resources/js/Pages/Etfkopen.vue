<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import Etf from './Etf.vue';


const props = defineProps({ Etf: Array })

const form = useForm({
  etf_id: '',
  aantal: 1,
  prijs_per_stuk: 0,
})

function submit() {
  const geselecteerd = props.aandelen.find(e => e.id === form.etf_id_id)
  form.prijs_per_stuk = geselecteerd ? geselecteerd.prijs : 0

  form.post(route('kopen/etf'), {
    onSuccess: () => form.reset(),
  })
}
</script>



<template>
    <NavBar />
    <AppLayout title="Wallet">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                Kopen Etf
            </h2>
        </template>
      

       
  <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-4">Koop je Etf</h1>

    <form @submit.prevent="submit" class="space-y-4">
      <select v-model="form.etf_id_id" class="w-full border rounded p-2">
        <option disabled value="">Selecteer Etf</option>
        <option v-for="e in props.etf" :key="e.id" :value="e.id">
          {{ e.naam }} (€{{ Number(e.prijs).toFixed(2) }})
        </option>
      </select>

      <input v-model="form.aantal" type="number" min="1" class="w-full border rounded p-2" />

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
        Kopen van je etf
      </button>
    </form>

    <div v-if="Object.keys(form.errors).length" class="mt-4 text-red-600">
      <div v-for="(msg, key) in form.errors" :key="key">{{ msg }}</div>
    </div>

    <div v-if="$page.props.flash?.success" class="mt-4 text-green-600">
      {{ $page.props.flash.success }}
    </div>
    <div v-if="form.errors.saldo" class="mt-4 text-red-600">
      {{ form.errors.saldo }}
    </div>
  </div>
</AppLayout>
  </template>