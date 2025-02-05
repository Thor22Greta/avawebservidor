<script setup>
import { defineProps } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout

const props = defineProps(["event"]);
</script>

<template>
    <AppLayout title="Detalles del Evento">
        <template #header>
            <h1 class="text-2xl font-bold text-green-600 p-2">Detalles del Evento</h1>
        </template>

        <div class="p-6">
            <h1 class="text-3xl font-bold text-green-600">{{ event.description }}</h1>
            <p class="text-gray-600"><strong>Fecha:</strong> {{ event.event_date }}</p>
            <p class="text-gray-600"><strong>Ubicación:</strong> {{ event.location }}</p>

            <div class="mt-4">
                <a href="/events" class="bg-gray-500 text-white p-2 rounded hover:bg-gray-400">Volver a la lista</a>
                <a :href="`/events/${event.id}/edit`" class="bg-green-600 text-white p-2 rounded ml-2 hover:bg-green-500">Editar</a>
            </div>
        </div>
    </AppLayout>
</template>
