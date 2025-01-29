<script setup>
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps(["donations"]);

const deleteDonation = (id) => {
    if (confirm("¿Estás seguro?")) {
        router.delete(`/donations/${id}`);
    }
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold">Donaciones</h1>
        <a href="/donations/create" class="bg-blue-500 text-white p-2">Agregar Donación</a>

        <table class="table-auto w-full mt-4 border">
            <thead>
                <tr>
                    <th class="border p-2">Usuario</th>
                    <th class="border p-2">Monto</th>
                    <th class="border p-2">Método de Pago</th>
                    <th class="border p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="donation in donations" :key="donation.id">
                    <td class="border p-2">{{ donation.user.name }}</td>
                    <td class="border p-2">${{ donation.amount }}</td>
                    <td class="border p-2">{{ donation.payment_method }}</td>
                    <td class="border p-2">
                        <a :href="`/donations/${donation.id}`" class="bg-blue-500 text-white p-1">Ver</a>
                        <a :href="`/donations/${donation.id}/edit`" class="bg-yellow-500 text-white p-1 ml-2">Editar</a>
                        <button @click="deleteDonation(donation.id)" class="bg-red-500 text-white p-1 ml-2">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
