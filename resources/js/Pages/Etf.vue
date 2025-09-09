<script setup>
const { etfs, sort, direction } = defineProps({
  etfs: Array,
  sort: String,
  direction: String
})
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
        <li class="nav-item me-4 opacity-100">
          <a class="navbar-brand" href="/">Mijn portfolio</a>
        </li>
      </ul>
    </div>
  </nav>

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
  </template>