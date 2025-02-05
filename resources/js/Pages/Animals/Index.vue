<script setup>
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout

const props = defineProps(["animals"]);

const deleteAnimal = (id) => {
    if (confirm("¿Estás seguro?")) {
        router.delete(`/animals/${id}`);
    }
};
</script>

<template>
    <AppLayout title="Animales">
        <template #header>
            <h1 class="text-2xl font-bold text-green-600 p-2">Animales</h1>
        </template>

        <div class="p-6">
            <a href="/animals/create" class="bg-green-600 text-white p-2 hover:bg-green-500">Agregar Animal</a>

            <table class="table-auto w-full mt-4 border border-green-600">
                <thead>
                    <tr>
                        <th class="border border-green-600 p-2">Nombre</th>
                        <th class="border border-green-600 p-2">Raza</th>
                        <th class="border border-green-600 p-2">Edad</th>
                        <th class="border border-green-600 p-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="animal in animals" :key="animal.id">
                        <td class="border border-green-600 p-2">{{ animal.name }}</td>
                        <td class="border border-green-600 p-2">{{ animal.raza }}</td>
                        <td class="border border-green-600 p-2">{{ animal.age }}</td>
                        <td class="border border-green-600 p-2">
                            <a :href="`/animals/${animal.id}`" class="bg-green-600 text-white p-1 hover:bg-green-500">Ver</a>
                            <a :href="`/animals/${animal.id}/edit`" class="bg-yellow-500 text-white p-1 ml-2 hover:bg-yellow-400">Editar</a>
                            <button @click="deleteAnimal(animal.id)" class="bg-red-500 text-white p-1 ml-2 hover:bg-red-400">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
