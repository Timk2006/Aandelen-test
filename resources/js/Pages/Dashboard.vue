<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBar from '@/Components/NavBar.vue';
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
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <Test />
                </div>
            </div>

            <div class="mt-6 bg-white shadow-md rounded-lg p-6 space-y-4 text-gray-700 leading-relaxed">
                <p>
                    Welkom bij de <strong>aandelen website</strong>!  
                    Deze website is ontwikkeld voor iedereen die meer wil leren over beleggen,
                    aandelen en ETF’s. Of je nu een beginner bent die net start of al wat ervaring hebt,
                    hier vind je duidelijke uitleg, voorbeelden en handige tips.
                </p>

                <p>
                    <strong>Wat zijn aandelen?</strong>  
                    Aandelen zijn eigendomsbewijzen van een bedrijf. Als je een aandeel koopt, zoals van
                    <em>Apple</em> of <em>Tesla</em>, word je mede-eigenaar van dat bedrijf.
                    Hierdoor kun je profiteren van koersstijgingen én eventuele dividenduitkeringen.
                    Als het bedrijf groeit en winst maakt, stijgt vaak ook de waarde van je aandeel.
                </p>

                <p>
                    <strong>Wat zijn ETF’s?</strong>  
                    Een ETF (Exchange Traded Fund) is een beleggingsfonds dat meerdere aandelen of
                    andere effecten bundelt. Een bekend voorbeeld is de
                    <em>S&amp;P500 ETF</em>, die de 500 grootste Amerikaanse bedrijven volgt.
                    Met één aankoop heb je dus meteen een goed gespreide portefeuille,
                    wat het risico verkleint in vergelijking met losse aandelen.
                </p>

                <p>
                    <strong>Waarom beleggen?</strong>  
                    Beleggen geeft je de kans om je vermogen te laten groeien op de lange termijn.
                    Het brengt echter ook risico’s met zich mee: koersen kunnen dalen en
                    rendement is nooit gegarandeerd. Door goed te spreiden en kennis op te doen,
                    vergroot je de kans op succes en verminder je onnodige risico’s.
                </p>

                <p>
                    Op deze website vind je uitleg over strategieën, risico’s en handige
                    tips om een portefeuille op te bouwen. Beleggen hoeft niet ingewikkeld te zijn –
                    met de juiste kennis kan iedereen leren hoe het werkt.
                </p>
            </div>
        </div>
    </AppLayout>
</template>
