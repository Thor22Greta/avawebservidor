<script setup>
import { ref, defineProps } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout


// Declaramos una interfaz para el usuario autenticado (esto es solo para fines de tipado en el editor)
/**
 * @typedef {Object} AuthUser
 * @property {number} id
 * @property {string} name
 * @property {string} email
 * // Puedes agregar otras propiedades según necesites
 */

const props = defineProps(["users", "animals", "events"]);
const { props: pageProps } = usePage();

// Aseguramos el tipado del usuario autenticado
/** @type {AuthUser} */
const authUser = pageProps.auth.user;

const form = ref({
    user_id: authUser.id,
    animal_id: "",
    event_id: "",
    amount: "",
    payment_method: "",
    donante: "",
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
                <!-- Campo para ingresar el nombre del donante -->
                
                    <label class="block mb-1 font-medium">Donante</label>
                    <textarea
                        v-model="form.donante"
                        placeholder="Escribe el nombre y apellido del donante o 'Anónimo'"
                        class="border border-green-600 p-2 w-full rounded"
                        required
                    ></textarea>
                

                <!-- Monto -->
                <input v-model="form.amount" type="number" placeholder="Monto" class="border border-green-600 p-2 w-full mb-2" required />

                <!-- Método de Pago - Ahora es un Select -->
                <label class="block mb-1 font-medium">Método de Pago</label>
                <select
                    v-model="form.payment_method"
                    class="border border-green-600 p-2 w-full mb-2"
                    required
                >
                    <option value="">Seleccione un método de pago</option>
                    <option value="cash">Efectivo</option>
                    <option value="transaction_id">ID de Transacción</option>
                </select>

                <!-- Botón de Guardar -->
                <button type="submit" class="bg-green-600 text-white p-2 w-full mt-4 hover:bg-green-500">Guardar</button>
            </form>

            <!-- Botón para Cancelar -->
            <a href="/donations" class="bg-gray-500 text-white p-2 w-full mt-4 block text-center hover:bg-gray-400">Cancelar</a>
        </div>
    </AppLayout>
</template>
