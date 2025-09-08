<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 p-6">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8">
      <h1 class="text-2xl font-bold text-gray-800 mb-6">Welkom bij de aandelen website hier kun je contact opnemen als je vr</h1>

      <form @submit.prevent="handleSubmit" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Naam</label>
          <input
            v-model="form.name"
            type="text"
            required
            class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">E-mail</label>
          <input
            v-model="form.email"
            type="email"
            required
            class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          />
        </div>

        <!-- Bericht -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Bericht</label>
          <textarea
            v-model="form.message"
            rows="4"
            required
            class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          ></textarea>
        </div>

        <!-- Versturen -->
        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
        >
          Versturen
        </button>
      </form>


      <p v-if="submitted" class="mt-4 text-green-600 font-medium">
        Bedankt voor je bericht! We nemen snel contact met je op.
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const form = ref({
  name: "tim",
  email: "koopstim430@gmail.com",
  message: "",
});

const submitted = ref(false);

function handleSubmit() {
  console.log("Formulier verstuurd:", form.value);

  
  submitted.value = true;

 
  form.value = { name: "", email: "", message: "" };
}
</script>
