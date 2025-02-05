<script setup>
import { defineProps, ref } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout

const props = defineProps(["donation", "users", "animals", "events"]);

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
    <AppLayout title="Editar Donación">
        <template #header>
            <h1 class="text-2xl font-bold text-green-600 p-2">Editar Donación</h1>
        </template>

        <div class="p-6">
            <form @submit.prevent="submit" class="space-y-4">
                <!-- Selector de Usuario -->
                <label class="block">Usuario:</label>
                <select v-model="form.user_id" class="border border-green-600 p-2 w-full mb-2" required>
                    <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                </select>

                <!-- Selector de Animal (opcional) -->
                <label class="block">Animal (opcional):</label>
                <select v-model="form.animal_id" class="border border-green-600 p-2 w-full mb-2">
                    <option value="">Ninguno</option>
                    <option v-for="animal in animals" :key="animal.id" :value="animal.id">{{ animal.name }}</option>
                </select>

                <!-- Selector de Evento (opcional) -->
                <label class="block">Evento (opcional):</label>
                <select v-model="form.event_id" class="border border-green-600 p-2 w-full mb-2">
                    <option value="">Ninguno</option>
                    <option v-for="event in events" :key="event.id" :value="event.id">{{ event.description }}</option>
                </select>

                <!-- Monto -->
                <input v-model="form.amount" type="number" placeholder="Monto" class="border border-green-600 p-2 w-full mb-2" required />

                <!-- Método de Pago -->
                <input v-model="form.payment_method" placeholder="Método de Pago" class="border border-green-600 p-2 w-full mb-2" required />

                <!-- Botón de Actualizar -->
                <button type="submit" class="bg-green-600 text-white p-2 w-full mt-4 hover:bg-green-500">Actualizar</button>

                <!-- Botón de Cancelar -->
                <a href="/donations" class="bg-red-500 text-white p-2 w-full mt-4 block text-center hover:bg-red-400">Cancelar</a>
            </form>
        </div>
    </AppLayout>
</template>
