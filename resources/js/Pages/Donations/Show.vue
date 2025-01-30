<script setup>
import { defineProps } from "vue";

const props = defineProps(["donation"]);
</script>

<template>
    <div class="p-6">
        <h1 class="text-3xl font-bold text-green-600">Detalle de Donación</h1>
        <p class="text-gray-600"><strong>Usuario:</strong> {{ donation.user.name }}</p>
        <p class="text-gray-600"><strong>Monto:</strong> ${{ donation.amount }}</p>
        <p class="text-gray-600"><strong>Método de Pago:</strong> {{ donation.payment_method }}</p>

        <div class="mt-4">
            <a href="/donations" class="bg-gray-500 text-white p-2 rounded hover:bg-gray-400">Volver</a>
        </div>
    </div>
</template>
