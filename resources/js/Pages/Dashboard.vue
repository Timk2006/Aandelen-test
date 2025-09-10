<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <NavBar />
    <AppLayout title="Dashboard test">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                Aandelen website
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Test />
                </div>
            </div>
<p class="text-gray-600">
    Welkom bij de aandelen website hier krijg je uitleg over aandelen zoals etfs en aandelen
</p>
            <div class="container mt-4">
    
        </div>
        </div>
    </AppLayout>
</template>
