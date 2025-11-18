<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';  

const props = defineProps({
  aandelen: Array
});
</script>

<template>
    <NavBar />
    <AppLayout title="Aandelen">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                Aandelen
            </h2>
        </template>

  <div class="container mt-4 p-4">
    <h1 class="mb-4">Aandelen die er bescikbaar zijn</h1>
    <table class="table table-striped p-4">
      <thead>
        <tr>
          <th>
            <a :href="`?sort=naam&direction=${$page.props.sort === 'naam' && $page.props.direction === 'asc' ? 'desc' : 'asc'}`">
              Aandeel
              <span v-if="$page.props.sort === 'naam'">{{$page.props.direction === 'asc' ? '▲' : '▼'}}</span>
            </a>
          </th>
          <th>
            <a :href="`?sort=prijs&direction=${$page.props.sort === 'prijs' && $page.props.direction === 'asc' ? 'desc' : 'asc'}`">
              Prijs
              <span v-if="$page.props.sort === 'prijs'">{{$page.props.direction === 'asc' ? '▲' : '▼'}}</span>
            </a>
          </th>
          <th>Omschrijving</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="aandeel in aandelen" :key="aandeel.id">
        <img v-if="aandeel.foto_url" :src="aandeel.foto_url" alt="Foto van aandeel" style="max-width: 80px; max-height: 80px;">

          <td>{{ aandeel.naam }}</td>
          <td>{{ aandeel.prijs }}</td>
          <td>{{ aandeel.omschrijving}}</td>
          <td>{{ aandeel.foto_url}}</td>
        </tr>
      </tbody>
    </table>

      <div class="container mt-4">
            <a href="/wallet" class="btn btn-primary mb-3">Ga naar je account om aandelen te kopen</a>
        </div>
  </div>
</AppLayout>
</template>