<script setup>
import { defineProps } from 'vue';
import NavBar from '../Components/NavBar.vue';

const props = defineProps({
  etfs: Array
});
</script>

<template>
    <nav class="navbar navbar-dark bg-primary flex-row z-index-3">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <ul class="navbar-nav me-auto mb-4 mb-lg-4 d-flex flex-row">
        <li class="nav-item">
          <a class="nav-link me-4" href="/">Home</a>
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
