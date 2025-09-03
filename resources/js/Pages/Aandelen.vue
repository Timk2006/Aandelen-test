<script setup>
import { defineProps } from 'vue';
import NavBar from '../Components/NavBar.vue';

const props = defineProps({
  aandelen: Array
});
</script>

<template>
  <NavBar />
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
  </div>
</template>

<style scoped>
.container {
  max-width: 950px;
}
</style>
