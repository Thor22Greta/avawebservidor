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
        <h1 class="text-2xl font-bold text-green-600 p-2">Eventos</h1>

        <a href="/events/create" class="bg-green-600 text-white p-2 hover:bg-green-500">Crear Evento</a>

        <table class="table-auto w-full mt-4 border border-green-600">
            <thead>
                <tr>
                    <th class="border border-green-600 p-2">Fecha</th>
                    <th class="border border-green-600 p-2">Descripción</th>
                    <th class="border border-green-600 p-2">Ubicación</th>
                    <th class="border border-green-600 p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="event in events" :key="event.id">
                    <td class="border border-green-600 p-2">{{ event.event_date }}</td>
                    <td class="border border-green-600 p-2">{{ event.description }}</td>
                    <td class="border border-green-600 p-2">{{ event.location }}</td>
                    <td class="border border-green-600 p-2">
                        <a :href="`/events/${event.id}`" class="bg-green-600 text-white p-1 hover:bg-green-500">Ver</a>
                        
                        <a :href="`/events/${event.id}/edit`" class="bg-yellow-500 text-white p-1 ml-2 hover:bg-yellow-400">Editar</a>
                        
                        <button @click="deleteEvent(event.id)" class="bg-red-500 text-white p-1 ml-2 hover:bg-red-400">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>