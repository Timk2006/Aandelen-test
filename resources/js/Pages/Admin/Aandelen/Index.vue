<script setup>
import { ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
  aandelen: Array
})

const naam = ref('')
const prijs = ref('')

const createAandeel = (e) => {
  e.preventDefault()
  Inertia.post('/aandelen/add', { naam: naam.value, prijs: prijs.value }, {
    onSuccess: () => {
      naam.value = ''
      prijs.value = ''
    }
  })
}

const confirmDelete = (id) => {
  if (!confirm('Weet je zeker dat je dit aandeel wilt verwijderen?')) return
  Inertia.delete(route('aandelen.destroy', id))
}
</script>

<template>
  <AppLayout title="Beheer Aandelen">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-900 leading-tight">Aandelen beheer</h2>
    </template>

    <div class="p-4">
      <div class="mb-6">
        <h3 class="text-lg font-medium mb-2">Nieuw aandeel toevoegen</h3>
        <form @submit="createAandeel" class="flex space-x-2">
          <input v-model="naam" placeholder="Naam" class="border px-2 py-1 rounded" />
          <input v-model="prijs" placeholder="Prijs" type="number" step="0.01" class="border px-2 py-1 rounded w-28" />
          <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded">Maak</button>
        </form>
      </div>

      <div>
        <h3 class="text-lg font-medium mb-2">Bestaande aandelen</h3>
        <table class="w-full table-auto">
          <thead>
            <tr class="text-left">
              <th class="pb-2">Naam</th>
              <th class="pb-2">Prijs</th>
              <th class="pb-2">Acties</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="a in props.aandelen" :key="a.id" class="border-t">
              <td class="py-2">{{ a.naam }}</td>
              <td class="py-2">€{{ Number(a.prijs).toFixed(2) }}</td>
              <td class="py-2">
                <button @click="() => confirmDelete(a.id)" class="text-red-600 hover:text-red-800">Verwijderen</button>
              </td>
            </tr>
            <tr v-if="props.aandelen.length === 0">
              <td colspan="3" class="py-4 text-gray-500">Geen aandelen gevonden.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AppLayout>
</template>
