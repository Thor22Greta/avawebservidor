<script setup>
import { defineProps } from "vue";

const props = defineProps(["event"]);
</script>

<template>
    <div class="p-6">
        <h1 class="text-3xl font-bold">{{ event.description }}</h1>
        <p class="text-gray-600"><strong>Fecha:</strong> {{ event.event_date }}</p>
        <p class="text-gray-600"><strong>Ubicación:</strong> {{ event.location }}</p>

        <div class="mt-4">
            <a href="/events" class="bg-gray-500 text-white p-2 rounded">Volver a la lista</a>
            <a :href="`/events/${event.id}/edit`" class="bg-yellow-500 text-white p-2 rounded ml-2">Editar</a>
        </div>
    </div>
</template>
