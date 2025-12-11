<script setup>
import { ref } from "vue";
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";



const onderwerp = ref("");
const vraag = ref("");
const antwoord = ref("");
const isTyping = ref(false);

const stelVraag = async () => {
  if (!vraag.value.trim()) return;

  try {
    isTyping.value = true;

    const response = await axios.post("/bot/vraag", {
      onderwerp: onderwerp.value || "chat",
      vraag: vraag.value,
    });

    antwoord.value = response.data.antwoord ?? "Geen antwoord ontvangen";
  } catch (error) {
    antwoord.value = "Er ging iets mis...";
  } finally {
    isTyping.value = false;
  }
};
</script>

<template>
  <AppLayout title="Vraag de Aandelen Bot">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-900 leading-tight">
        Stel je vraag aan de Aandelen Bot
      </h2>
    </template>

    <div class="p-6 max-w-md mx-auto">
      <form @submit.prevent="stelVraag">
        <label class="block mb-2 font-semibold">Onderwerp</label>
        <select v-model="onderwerp" class="border p-2 w-full rounded mb-4">
          <option disabled value="">Kies een onderwerp</option>
          <option value="aandelen">Aandelen</option>
          <option value="etf">ETF</option>
          <option value="wallet">Wallet</option>
          <option value="algemeen">Algemene vraag</option>
        </select>

        <label class="block mb-2 font-semibold">Je vraag</label>
        <textarea
          v-model="vraag"
          placeholder="Bijvoorbeeld hoe koop ik aandelen"
          class="border p-2 w-full rounded mb-4"
          rows="4"
          required
        ></textarea>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
          Verstuur
        </button>
      </form>

      <div v-if="isTyping" class="mt-4 text-gray-500 text-sm">
        De bot is aan het typen
      </div>

      <div v-if="antwoord" class="mt-6">
        <h2 class="font-semibold">Antwoord van de bot:</h2>
        <p class="mt-2">{{ antwoord }}</p>
      </div>
    </div>
  </AppLayout>
</template>
