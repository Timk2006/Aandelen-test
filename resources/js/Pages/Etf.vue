<script setup>
import { defineProps } from 'vue';
import NavBar from '../Components/NavBar.vue';

const props = defineProps({
  etfs: Array
});
</script>

<template>
  <NavBar />
  <div class="container mt-4 p-4">
    <h1 class="mb-4">Etfs die er bescikbaar zijn</h1>
    <table class="table table-striped p-4">
      <thead>
        <tr>
    <th>Etf</th>
    <th>Prijs</th>
    <th>Omschrijving</th>
  </tr>
        <tr>
          <th>
            <a :href="`?sort=naam&direction=${$page.props.sort === 'naam' && $page.props.direction === 'asc' ? 'desc' : 'asc'}`">
             
              <span v-if="$page.props.sort === 'naam'">{{$page.props.direction === 'asc' ? '▲' : '▼'}}</span>
            </a>
          </th>
          <th>
            <a :href="`?sort=prijs&direction=${$page.props.sort === 'prijs' && $page.props.direction === 'asc' ? 'desc' : 'asc'}`">
             
              <span v-if="$page.props.sort === 'prijs'">{{$page.props.direction === 'asc' ? '▲' : '▼'}}</span>
            </a>
          </th>
        </tr>
      </thead>
<tbody>
  <tr v-for="etf in etfs" :key="etf.id">
    <td>
      <img v-if="etf.foto_url" :src="etf.foto_url" alt="Foto van een etf" style="max-width: 80px; max-height: 80px;">
    </td>
    <td>{{ etf.naam }}</td>
    <td>{{ etf.prijs }}</td>
    <td>{{ etf.omschrijving }}</td>
  </tr>
</tbody>

    </table>

      <div class="container mt-4">
            <a href="/wallet" class="btn btn-primary mb-3">Ga naar je account om efts te kopen met je saldo</a>
        </div>
  </div>
</template>

<style scoped>
.container {
  max-width: 950px;
}
</style>
