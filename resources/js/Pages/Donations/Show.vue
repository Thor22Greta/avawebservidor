<script setup>
import { defineProps } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout

const props = defineProps(["donation"]);
</script>

<template>
    <AppLayout title="Detalle de Donación">
        <template #header>
            <h1 class="text-2xl font-bold text-green-600 p-2">Detalle de Donación</h1>
        </template>

        <div class="p-6">
            <!-- Detalle de la donación -->
            <div class="space-y-4">
                <p class="text-gray-600"><strong>Usuario:</strong> {{ donation.user.name }}</p>
                <p class="text-gray-600"><strong>Monto:</strong> ${{ donation.amount }}</p>
                <p class="text-gray-600"><strong>Método de Pago:</strong> {{ donation.payment_method }}</p>
            </div>

            <!-- Botón Volver -->
            <div class="mt-4">
                <a href="/donations" class="bg-gray-500 text-white p-2 rounded hover:bg-gray-400">Volver</a>
            </div>
        </div>
    </AppLayout>
</template>
