<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
const { etfs, sort, direction } = defineProps({
  etfs: Array,
  sort: String,
  direction: String
})
</script>


<template>
    <NavBar />
    <AppLayout title="Etf">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                Etf
            </h2>
        </template>


  <div class="container mt-4 p-4">
    <h1 class="mb-4">Beschikbare ETFs</h1>
    <table class="table table-striped p-4">
      <thead>
        <tr>
          <th>
            <a :href="`/etf?sort=naam&direction=${sort === 'naam' && direction === 'asc' ? 'desc' : 'asc'}`">
              Naam
              <span v-if="sort === 'naam'">{{ direction === 'asc' ? '▲' : '▼' }}</span>
            </a>
          </th>
          <th>
            <a :href="`/etf?sort=prijs&direction=${sort === 'prijs' && direction === 'asc' ? 'desc' : 'asc'}`">
              Prijs
              <span v-if="sort === 'prijs'">{{ direction === 'asc' ? '▲' : '▼' }}</span>
            </a>
          </th>
          <th>Omschrijving</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="etf in etfs" :key="etf.id">
          <td>{{ etf.naam }}</td>
          <td>{{ etf.prijs }}</td>
          <td>{{ etf.omschrijving }}</td>
          <td>
</td>
</tr>
      </tbody>
    </table>
  </div>
</applayout>
  </template>