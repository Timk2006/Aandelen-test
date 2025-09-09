<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ aandelen: Array })
const form = useForm({ stock_id: '', aantal: 1 })

function submit() {
  form.post(route('kopen'))
}
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
          <a class="nav-link" href="/wallet">Wallet</a>
        </li>
        <a class="navbar-brand me-4 opacity-100" href="/">Mijn porffolio</a>
      </ul>
    </div>
  </nav>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow">
    <h1 class="text-2xl font-bold mb-6">Koop aandelen</h1>

    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block text-sm font-medium mb-1">Kies aandeel</label>
        <select v-model="form.stock_id" class="w-full border rounded p-2">
          <option disabled value="">-- Selecteer --</option>
          <option v-for="a in props.aandelen" :key="a.id" :value="a.id">
            {{ a.naam }} (€{{ a.prijs }})
          </option>
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Aantal</label>
        <input v-model="form.aantal" type="number" min="1"
          class="w-full border rounded p-2" />
      </div>

      <button type="submit"
        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 disabled:opacity-50"
        :disabled="form.processing">
        Koop aandelen
      </button>
    </form>

    <!-- Foutmeldingen -->
    <div v-if="Object.keys(form.errors).length" class="mt-4 text-red-600">
      <div v-for="(msg, key) in form.errors" :key="key">{{ msg }}</div>
    </div>

    <!-- Succesbericht -->
    <div v-if="$page.props.flash?.success" class="mt-4 text-green-600">
      {{ $page.props.flash.success }}
    </div>
  </div>
</template>