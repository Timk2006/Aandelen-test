<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
  aandelen: Array, // aandelen die de gebruiker bezit
})

const verkoopForm = useForm({
  id: '',
  aantal: 1,
  type: 'aandeel'
})

function submitVerkoop() {
  verkoopForm.post(route('verkoop'), {
    onSuccess: () => verkoopForm.reset(),
  })
}
</script>

<template>
  <AppLayout title="Verkoop Aandelen">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-900 leading-tight">
        Verkopen
      </h2>
    </template>

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded shadow">
      <h1 class="text-lg font-bold mb-4">Verkoop je aandelen</h1>

      <form @submit.prevent="submitVerkoop" class="space-y-4">
        <select v-model="verkoopForm.id" class="w-full border rounded p-2">
          <option disabled value="">Selecteer aandeel</option>
          <option
            v-for="a in props.aandelen"
            :key="a.id"
            :value="a.id"
          >
            {{ a.naam }} ({{ a.aantal }} stuks) - €{{ Number(a.prijs).toFixed(2) }}
          </option>
        </select>

        <input
          v-model="verkoopForm.aantal"
          type="number"
          min="1"
          class="w-full border rounded p-2"
          placeholder="Aantal te verkopen"
        />

        <button
          type="submit"
          class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700"
        >
          Verkoop aandeel
        </button>
      </form>

      <div v-if="Object.keys(verkoopForm.errors).length" class="mt-4 text-red-600">
        <div v-for="(msg, key) in verkoopForm.errors" :key="key">{{ msg }}</div>
      </div>

      <div v-if="$page.props.flash?.success" class="mt-4 text-green-600">
        {{ $page.props.flash.success }}
      </div>
    </div>

    <footer class="mt-6 text-center text-sm text-gray-500">
      Gemaakt door Tim Koops
    </footer>
  </AppLayout>
</template>
