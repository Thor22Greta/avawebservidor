<script setup>
import { defineProps } from "vue";

const props = defineProps(["donation"]);
</script>

<template>
    <div class="p-6">
        <h1 class="text-3xl font-bold">Detalle de Donación</h1>
        <p><strong>Usuario:</strong> {{ donation.user.name }}</p>
        <p><strong>Monto:</strong> ${{ donation.amount }}</p>
        <p><strong>Método de Pago:</strong> {{ donation.payment_method }}</p>

        <div class="mt-4">
            <a href="/donations" class="bg-gray-500 text-white p-2 rounded">Volver</a>
        </div>
    </div>
</template>
