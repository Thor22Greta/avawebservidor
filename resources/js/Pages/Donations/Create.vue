<script setup>
import { ref, defineProps } from "vue";
import { router } from "@inertiajs/vue3";

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
    <div class="p-6">
        <h1 class="text-2xl font-bold">Registrar Donación</h1>
        <form @submit.prevent="submit" class="mt-4">
            <select v-model="form.user_id" class="border p-2 w-full mb-2" required>
                <option value="">Selecciona un usuario</option>
                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
            </select>
            <input v-model="form.amount" type="number" placeholder="Monto" class="border p-2 w-full mb-2" required />
            <input v-model="form.payment_method" placeholder="Método de Pago" class="border p-2 w-full mb-2" required />
            <button type="submit" class="bg-green-500 text-white p-2">Guardar</button>
        </form>
    </div>
</template>
