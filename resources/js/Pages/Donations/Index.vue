<script setup>
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout

const props = defineProps(["donations"]);

const deleteDonation = (id) => {
    if (confirm("¿Estás seguro?")) {
        router.delete(`/donations/${id}`);
    }
};
</script>

<template>
    <AppLayout title="Donaciones">
        <template #header>
            <h1 class="text-2xl font-bold text-green-600 p-2">Donaciones</h1>
        </template>

        <div class="p-6">
            <a href="/donations/create" class="bg-green-600 text-white p-2 hover:bg-green-500">Agregar Donación</a>

            <table class="table-auto w-full mt-4 border border-green-600">
                <thead>
                    <tr>
                        <th class="border border-green-600 p-2">Usuario</th>
                        <th class="border border-green-600 p-2">Monto</th>
                        <th class="border border-green-600 p-2">Método de Pago</th>
                        <th class="border border-green-600 p-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="donation in donations" :key="donation.id">
                        <td class="border border-green-600 p-2">{{ donation.user.name }}</td>
                        <td class="border border-green-600 p-2">${{ donation.amount }}</td>
                        <td class="border border-green-600 p-2">{{ donation.payment_method }}</td>
                        <td class="border border-green-600 p-2">
                            <a :href="`/donations/${donation.id}`" class="bg-green-600 text-white p-1 hover:bg-green-500">Ver</a>
                            <a :href="`/donations/${donation.id}/edit`" class="bg-yellow-500 text-white p-1 ml-2 hover:bg-yellow-400">Editar</a>
                            <button @click="deleteDonation(donation.id)" class="bg-red-500 text-white p-1 ml-2 hover:bg-red-400">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
