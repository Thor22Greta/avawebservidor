<script setup>
import { defineProps } from "vue";

const props = defineProps(["animal"]);
</script>

<template>
    <div class="p-6">
        <h1 class="text-3xl font-bold">{{ animal.name }}</h1>
        <p class="text-gray-600"><strong>Raza:</strong> {{ animal.raza }}</p>
        <p class="text-gray-600"><strong>Edad:</strong> {{ animal.age }} años</p>
        <p class="text-gray-600"><strong>Chip:</strong> {{ animal.chip || "No registrado" }}</p>

        <div class="mt-4">
            <a href="/animals" class="bg-gray-500 text-white p-2 rounded">Volver</a>
            <a :href="`/animals/${animal.id}/edit`" class="bg-yellow-500 text-white p-2 rounded ml-2">Editar</a>
        </div>
    </div>
</template>
