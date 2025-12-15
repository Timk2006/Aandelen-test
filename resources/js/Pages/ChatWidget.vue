<!-- resources/js/Components/Partials/ChatWidget.vue -->
<template>
  <div class="chat-widget">
    <button class="chat-toggle" @click="toggleChat">
      {{ open ? "×" : "Chat met mij" }}
    </button>

    <div v-if="open" class="chat-panel">
      <div v-if="!started" class="intro">
        <h2>Welkom bij de Aandelen bot</h2>
        <p>Chat met de aandelen bot voor antwoorden op je vraag.</p>
        <button class="intro-btn" @click="startChat">Stuur ons een bericht</button>
      </div>

      <div v-else class="chat-body">
        <div class="messages">
          <div v-for="(msg, index) in messages" :key="index" :class="msg.type">
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
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      open: false,
      started: false,
      userInput: "",
      messages: [],
    };
  },
  methods: {
    toggleChat() {
      this.open = !this.open;
    },

    startChat() {
      this.started = true;
    },

    async sendMessage() {
      if (!this.userInput.trim()) return;

      this.started = true;

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

/* knop rechtsonder zoals je screenshot */
.chat-toggle {
  background-color: #e11b22;
  color: white;
  border: none;
  border-radius: 999px;
  padding: 12px 16px;
  font-size: 14px;
  font-weight: 700;
  cursor: pointer;
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.22);
}

.chat-panel {
  width: 360px;
  height: 520px;
  background: #f3f5f7;
  border: 1px solid #e6e6e6;
  border-radius: 18px;
  margin-bottom: 12px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.intro {
  flex: 1;
  padding: 36px 24px;
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 12px;
}

.intro h2 {
  margin: 0;
  font-size: 28px;
  font-weight: 900;
  color: #111;
}

.intro p {
  margin: 0;
  color: rgba(0, 0, 0, 0.7);
  line-height: 1.45;
}

.intro-btn {
  margin-top: 10px;
  background: #e11b22;
  color: #fff;
  border: 0;
  border-radius: 999px;
  padding: 14px 18px;
  font-weight: 900;
  cursor: pointer;
}

.chat-body {
  flex: 1;
  display: flex;
  flex-direction: column;
  background: white;
}

.messages {
  flex: 1;
  overflow-y: auto;
  padding: 15px;
  background: #f3f5f7;
}

.user {
  text-align: right;
  margin: 6px 0;
  color: #111;
}

.bot {
  text-align: left;
  margin: 6px 0;
  color: #e11b22;
}

input {
  border: none;
  border-top: 1px solid #e6e6e6;
  padding: 12px;
  outline: none;
}
</style>
