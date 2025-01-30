<script setup>
import { defineProps, ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps(["event"]);

const form = ref({
    event_date: props.event.event_date,
    description: props.event.description,
    location: props.event.location,
});

const submit = () => {
    router.put(`/events/${props.event.id}`, form.value);
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold text-green-600">Editar Evento</h1>
        <form @submit.prevent="submit" class="space-y-2">
            <input v-model="form.event_date" type="date" class="border-green-600 border p-2 w-full" required />
            <input v-model="form.description" type="text" placeholder="Descripción" class="border-green-600 border p-2 w-full" required />
            <input v-model="form.location" type="text" placeholder="Ubicación" class="border-green-600 border p-2 w-full" required />

            <button type="submit" class="bg-green-600 text-white p-2 hover:bg-green-500 w-full mt-4">Actualizar</button>
            <a href="/events" class="bg-red-500 text-white p-2 hover:bg-red-400 w-full mt-4 block text-center">Cancelar</a>
        </form>
    </div>
</template>
