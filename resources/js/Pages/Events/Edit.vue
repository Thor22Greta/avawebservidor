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
        <h1 class="text-2xl font-bold">Editar Evento</h1>
        <form @submit.prevent="submit" class="space-y-2">
            <input v-model="form.event_date" type="date" class="border p-2 w-full" required />
            <input v-model="form.description" type="text" placeholder="Descripción" class="border p-2 w-full" required />
            <input v-model="form.location" type="text" placeholder="Ubicación" class="border p-2 w-full" required />

            <button type="submit" class="bg-blue-500 text-white p-2">Actualizar</button>
            <a href="/events" class="bg-gray-500 text-white p-2 ml-2">Cancelar</a>
        </form>
    </div>
</template>
