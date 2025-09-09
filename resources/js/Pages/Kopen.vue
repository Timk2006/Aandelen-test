<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ aandelen: Array })

const form = useForm({
  aandeel_id: '',
  aantal: 1,
  prijs_per_stuk: 0,
})

function submit() {
  const geselecteerd = props.aandelen.find(a => a.id === form.aandeel_id)
  form.prijs_per_stuk = geselecteerd ? geselecteerd.prijs : 0

  form.post(route('kopen'), {
    onSuccess: () => form.reset(),
  })
}
</script>

<template>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-4">Koop aandelen</h1>

    <form @submit.prevent="submit" class="space-y-4">
      <select v-model="form.aandeel_id" class="w-full border rounded p-2">
        <option disabled value="">Selecteer aandeel</option>
        <option v-for="a in props.aandelen" :key="a.id" :value="a.id">
          {{ a.naam }} (€{{ Number(a.prijs).toFixed(2) }})
        </option>
      </select>

      <input v-model="form.aantal" type="number" min="1" class="w-full border rounded p-2" />

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
        Koop
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
</template>
