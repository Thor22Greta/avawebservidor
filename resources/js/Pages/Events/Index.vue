<script setup>
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps(["events"]);

const deleteEvent = (id) => {
    if (confirm("¿Estás seguro?")) {
        router.delete(`/events/${id}`);
    }
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold">Eventos</h1>
        <a href="/events/create" class="bg-blue-500 text-white p-2">Crear Evento</a>

        <table class="table-auto w-full mt-4 border">
            <thead>
                <tr>
                    <th class="border p-2">Fecha</th>
                    <th class="border p-2">Descripción</th>
                    <th class="border p-2">Ubicación</th>
                    <th class="border p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="event in events" :key="event.id">
                    <td class="border p-2">{{ event.event_date }}</td>
                    <td class="border p-2">{{ event.description }}</td>
                    <td class="border p-2">{{ event.location }}</td>
                    <td class="border p-2">
                        <a :href="`/events/${event.id}`" class="bg-blue-500 text-white p-1">Ver</a>
                        <a :href="`/events/${event.id}/edit`" class="bg-yellow-500 text-white p-1 ml-2">Editar</a>
                        <button @click="deleteEvent(event.id)" class="bg-red-500 text-white p-1 ml-2">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
