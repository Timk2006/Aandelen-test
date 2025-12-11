<!-- resources/js/Components/Partials/ChatWidget.vue -->
<template>
  <div class="chat-widget">
    <button class="chat-toggle" @click="toggleChat">
      {{ open ? "×" : "Chat" }}
    </button>

    <div v-if="open" class="chat-panel">
      <div class="messages">
        <div
          v-for="(msg, index) in messages"
          :key="index"
          :class="msg.type"
        >
          {{ msg.text }}
        </div>
      </div>

      <input
        v-model="userInput"
        @keyup.enter="sendMessage"
        placeholder="Typ je bericht..."
      />
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      open: false,
      userInput: "",
      messages: [],
    };
  },
  methods: {
    toggleChat() {
      this.open = !this.open;
    },

    async sendMessage() {
      if (!this.userInput.trim()) return;

      // eigen bericht tonen
      this.messages.push({
        text: this.userInput,
        type: "user",
      });

      const vraag = this.userInput;
      this.userInput = "";

      try {
        const response = await axios.post("/bot/vraag", {
          vraag,
          onderwerp: "chat",
        });

        this.messages.push({
          text: response.data.antwoord ?? "Geen antwoord ontvangen",
          type: "bot",
        });
      } catch (e) {
        this.messages.push({
          text: "Er ging iets mis...",
          type: "bot",
        });
      }
    },
  },
};
</script>

<style scoped>
.chat-widget {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 9999;
}

.chat-toggle {
  background-color: #6b5b95;
  color: white;
  border: none;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  font-size: 18px;
  cursor: pointer;
}

.chat-panel {
  width: 300px;
  height: 400px;
  background: white;
  border: 1px solid #ccc;
  border-radius: 10px;
  margin-bottom: 10px;
  display: flex;
  flex-direction: column;
}

.messages {
  flex: 1;
  overflow-y: auto;
  padding: 10px;
}

.user {
  text-align: right;
  margin: 5px 0;
  color: #333;
}

.bot {
  text-align: left;
  margin: 5px 0;
  color: #6b5b95;
}

input {
  border: none;
  border-top: 1px solid #ccc;
  padding: 10px;
}
</style>
