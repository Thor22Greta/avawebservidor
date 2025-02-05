<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout

const form = ref({
    event_date: "",
    description: "",
    location: "",
});

const submit = () => {
    router.post("/events", form.value);
};
</script>

<template>
    <AppLayout title="Crear Evento">
        <template #header>
            <h1 class="text-2xl font-bold text-green-600 p-2">Crear Evento</h1>
        </template>

        <div class="p-6">
            <form @submit.prevent="submit" class="space-y-4">
                <input v-model="form.event_date" type="date" class="border border-green-600 p-2 w-full" required />
                <input v-model="form.description" type="text" placeholder="Descripción" class="border border-green-600 p-2 w-full" required />
                <input v-model="form.location" type="text" placeholder="Ubicación" class="border border-green-600 p-2 w-full" required />

                <button type="submit" class="bg-green-600 text-white p-2 hover:bg-green-500 w-full mt-4">Guardar</button>
                <a href="/events" class="bg-gray-500 text-white p-2 hover:bg-gray-400 w-full mt-4 block text-center">Cancelar</a>
            </form>
        </div>
    </AppLayout>
</template>
