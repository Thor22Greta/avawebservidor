<script setup>
import { ref, onMounted } from "vue";

const events = ref([]);
const form = ref({ event_date: "", description: "", location: "" });
const isEditing = ref(false);
const eventId = ref(null);

const fetchEvents = async () => {
    const response = await fetch("/api/events");
    events.value = await response.json();
};

const saveEvent = async () => {
    const method = isEditing.value ? "PUT" : "POST";
    const url = isEditing.value ? `/api/events/${eventId.value}` : "/api/events";

    await fetch(url, {
        method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(form.value),
    });

    resetForm();
    fetchEvents();
};

const editEvent = (event) => {
    form.value = { ...event };
    eventId.value = event.id;
    isEditing.value = true;
};

const deleteEvent = async (id) => {
    await fetch(`/api/events/${id}`, { method: "DELETE" });
    fetchEvents();
};

const resetForm = () => {
    form.value = { event_date: "", description: "", location: "" };
    isEditing.value = false;
    eventId.value = null;
};

onMounted(fetchEvents);
</script>

<template>
    <div class="p-4">
        <h1 class="text-2xl font-bold">Gestión de Eventos</h1>

        <form @submit.prevent="saveEvent" class="mt-4 space-y-2">
            <input v-model="form.event_date" type="date" class="border p-2 w-full" required />
            <input v-model="form.description" type="text" placeholder="Descripción" class="border p-2 w-full" required />
            <input v-model="form.location" type="text" placeholder="Ubicación" class="border p-2 w-full" required />
            
            <button type="submit" class="bg-blue-500 text-white p-2">
                {{ isEditing ? "Actualizar" : "Crear" }} Evento
            </button>
            <button v-if="isEditing" @click="resetForm" class="bg-gray-500 text-white p-2 ml-2">Cancelar</button>
        </form>

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
                        <button @click="editEvent(event)" class="bg-yellow-500 text-white p-1">Editar</button>
                        <button @click="deleteEvent(event.id)" class="bg-red-500 text-white p-1 ml-2">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
