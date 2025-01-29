<script setup>
import { defineProps, ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps(["donation", "users", "animals", "events"]);

// Crear un formulario con los datos actuales de la donación
const form = ref({
    user_id: props.donation.user_id,
    animal_id: props.donation.animal_id,
    event_id: props.donation.event_id,
    amount: props.donation.amount,
    payment_method: props.donation.payment_method,
});

const submit = () => {
    router.put(`/donations/${props.donation.id}`, form.value);
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold">Editar Donación</h1>
        <form @submit.prevent="submit" class="mt-4">
            <label class="block">Usuario:</label>
            <select v-model="form.user_id" class="border p-2 w-full mb-2" required>
                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
            </select>

            <label class="block">Animal (opcional):</label>
            <select v-model="form.animal_id" class="border p-2 w-full mb-2">
                <option value="">Ninguno</option>
                <option v-for="animal in animals" :key="animal.id" :value="animal.id">{{ animal.name }}</option>
            </select>

            <label class="block">Evento (opcional):</label>
            <select v-model="form.event_id" class="border p-2 w-full mb-2">
                <option value="">Ninguno</option>
                <option v-for="event in events" :key="event.id" :value="event.id">{{ event.description }}</option>
            </select>

            <input v-model="form.amount" type="number" placeholder="Monto" class="border p-2 w-full mb-2" required />
            <input v-model="form.payment_method" placeholder="Método de Pago" class="border p-2 w-full mb-2" required />

            <button type="submit" class="bg-yellow-500 text-white p-2">Actualizar</button>
            <a href="/donations" class="bg-gray-500 text-white p-2 ml-2">Cancelar</a>
        </form>
    </div>
</template>
