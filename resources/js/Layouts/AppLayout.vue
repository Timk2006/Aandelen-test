<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ChatWidget from "@/Pages/ChatWidget.vue";



defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const query = ref('');
const results = ref(null);

const search = async () => {
    if (query.value.length < 2) {
        results.value = null;
        return;
    }
    const r = await fetch(`/api/search?q=${encodeURIComponent(query.value)}`);
    results.value = await r.json();
};

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />
        <Banner />
    </div>

    <!-- MAIN NAVIGATION -->
    <nav class="fixed top-0 inset-x-0 z-50 bg-white border-b border-gray-100 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- LEFT: LOGO -->
                <div class="flex items-center space-x-3">
                    <Link :href="route('dashboard')">
                        <img 
                            src="/images/mylogo.png" 
                            alt="Logo" 
                            class="h-10 w-auto object-contain"
                        >
                    </Link>
                </div>

                <!-- CENTER: NAVLINKS (ONAANGEPAST!!) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </NavLink>
                    <NavLink :href="route('aandelen')" :active="route().current('aandelen')">
                        Aandelen
                    </NavLink>
                    <NavLink :href="route('etf')" :active="route().current('etf')">
                        Etf
                    </NavLink>
                    <NavLink :href="route('wallet')" :active="route().current('wallet')">
                        Wallet
                    </NavLink>
                    <NavLink :href="route('Etfkopen')" :active="route().current('Etfkopen')">
                        Kopen Etf
                    </NavLink>
                    <NavLink :href="route('kopen')" :active="route().current('kopen')">
                        Kopen Aandelen
                    </NavLink>
                    <NavLink :href="route('portfolio')" :active="route().current('portfolio')">
                        Portfolio
                    </NavLink>
                    <NavLink :href="route('bot')" :active="route().current('bot')">
                        Vragen Chatbot
                    </NavLink>
                    <NavLink :href="route('verkoop')" :active="route().current('verkoop')">
                        Verkopen
                    </NavLink>
                </div>

                <!-- RIGHT: SEARCH + PROFILE -->
                <div class="hidden sm:flex sm:items-center space-x-6">

                    <!-- SEARCHBAR -->
                    <div class="relative">
                        <input 
                            v-model="query"
                            @input="search"
                            placeholder="Zoek..."
                            class="border px-3 py-1.5 rounded-md"
                        />

                        <div 
                            v-if="results && query" 
                            class="absolute bg-white border rounded mt-2 p-2 w-56 shadow z-50"
                        >
                            <div v-if="results.pages.length">
                                <strong>Pagina's</strong>
                                <div v-for="p in results.pages" :key="p.url">
                                    <a :href="p.url">{{ p.name }}</a>
                                </div>
                            </div>

                            <div v-if="results.aandelen.length" class="mt-2">
                                <strong>Aandelen</strong>
                                <div v-for="a in results.aandelen" :key="a.id">
                                    {{ a.naam }}
                                </div>
                            </div>

                            <div v-if="results.etfs.length" class="mt-2">
                                <strong>ETF's</strong>
                                <div v-for="e in results.etfs" :key="e.id">
                                    {{ e.naam }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PROFILE DROPDOWN -->
                    <div class="relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button
                                    v-if="$page.props.jetstream.managesProfilePhotos"
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                >
                                    <img
                                        class="size-8 rounded-full object-cover"
                                        :src="$page.props.auth.user.profile_photo_url"
                                        :alt="$page.props.auth.user.name"
                                    />
                                </button>
                            </template>

                            <template #content>
                                <div class="block px-4 py-2 text-xs text-gray-400">Manage Account</div>

                                <DropdownLink :href="route('profile.show')">Profile</DropdownLink>
                                <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                    API Tokens
                                </DropdownLink>

                                <div class="border-t border-gray-200" />

                                <form @submit.prevent="logout">
                                    <DropdownLink as="button">Log Out</DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                    </div>

                </div>

                <!-- MOBILE MENU BUTTON -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button
                        class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition"
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                    >
                        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown}" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown}" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <div class="pt-16 min-h-screen bg-gray-100">
        <main>
            <slot />
            
        </main>

        <ChatWidget />  <!-- dit is nieuw -->
    </div>
</template>
