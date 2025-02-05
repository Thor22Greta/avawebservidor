<script setup>
import { defineProps } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout

const props = defineProps(["animal"]);
</script>

<template>
    <AppLayout title="Detalles del Animal">
        <template #header>
            <h1 class="text-2xl font-bold text-green-600 p-2">{{ animal.name }}</h1>
        </template>

        <div class="p-6">
            <div class="mb-4">
                <p class="text-gray-600"><strong>Raza:</strong> {{ animal.raza }}</p>
                <p class="text-gray-600"><strong>Edad:</strong> {{ animal.age }} años</p>
                <p class="text-gray-600"><strong>Chip:</strong> {{ animal.chip || "No registrado" }}</p>
            </div>

            <div class="mt-4">
                <a href="/animals" class="bg-gray-500 text-white p-2 rounded hover:bg-gray-400">Volver</a>
                <a :href="`/animals/${animal.id}/edit`" class="bg-green-600 text-white p-2 rounded ml-2 hover:bg-green-500">Editar</a>
            </div>
        </div>
    </AppLayout>
</template>
