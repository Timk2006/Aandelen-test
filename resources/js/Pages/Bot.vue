
  <template>
  <div class="p-6 max-w-md mx-auto">
    <h1 class="text-xl font-bold mb-4">Stel je vraag aan de Aandelen Bot</h1>

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
        placeholder="Bijv. Hoe koop ik aandelen?"
        class="border p-2 w-full rounded mb-4"
        rows="4"
        required
      ></textarea>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
        Verstuur
      </button>
    </form>

    <div v-if="antwoord" class="mt-6">
      <h2 class="font-semibold">Antwoord van de bot:</h2>
      <p class="mt-2">{{ antwoord }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";


const onderwerp = ref("");
const vraag = ref("");
const antwoord = ref("");

const stelVraag = async () => {
  try {
  const response = await axios.post("/bot/vraag", {
      onderwerp: onderwerp.value,
      vraag: vraag.value,
    });
    antwoord.value = response.data.antwoord;
    vraag.value = "";
    onderwerp.value = "";
  } catch (error) {
    antwoord.value = "Er ging iets mis...";
  }
};
</script>
