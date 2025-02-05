<script setup>
import { ref, defineProps } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout

const props = defineProps(["users", "animals", "events"]);

const form = ref({
    user_id: "",
    animal_id: "",
    event_id: "",
    amount: "",
    payment_method: "",
});

const submit = () => {
    router.post("/donations", form.value);
};
</script>

<template>
    <AppLayout title="Registrar Donación">
        <template #header>
            <h1 class="text-2xl font-bold text-green-600 p-2">Registrar Donación</h1>
        </template>

        <div class="p-6">
            <form @submit.prevent="submit" class="space-y-4">
                <!-- Selector de Usuario -->
                <select v-model="form.user_id" class="border border-green-600 p-2 w-full mb-2" required>
                    <option value="">Selecciona un usuario</option>
                    <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                </select>

                <!-- Monto -->
                <input v-model="form.amount" type="number" placeholder="Monto" class="border border-green-600 p-2 w-full mb-2" required />

                <!-- Método de Pago -->
                <input v-model="form.payment_method" placeholder="Método de Pago" class="border border-green-600 p-2 w-full mb-2" required />

                <!-- Botón de Guardar -->
                <button type="submit" class="bg-green-600 text-white p-2 w-full mt-4 hover:bg-green-500">Guardar</button>
            </form>

            <!-- Botón para Cancelar -->
            <a href="/donations" class="bg-gray-500 text-white p-2 w-full mt-4 block text-center hover:bg-gray-400">Cancelar</a>
        </div>
    </AppLayout>
</template>
