<script setup>
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps(["animals"]);

const deleteAnimal = (id) => {
    if (confirm("¿Estás seguro?")) {
        router.delete(`/animals/${id}`);
    }
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold">Animales</h1>
        <a href="/animals/create" class="bg-blue-500 text-white p-2">Agregar Animal</a>

        <table class="table-auto w-full mt-4 border">
            <thead>
                <tr>
                    <th class="border p-2">Nombre</th>
                    <th class="border p-2">Raza</th>
                    <th class="border p-2">Edad</th>
                    <th class="border p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="animal in animals" :key="animal.id">
                    <td class="border p-2">{{ animal.name }}</td>
                    <td class="border p-2">{{ animal.raza }}</td>
                    <td class="border p-2">{{ animal.age }}</td>
                    <td class="border p-2">
                        <a :href="`/animals/${animal.id}`" class="bg-blue-500 text-white p-1">Ver</a>
                        <a :href="`/animals/${animal.id}/edit`" class="bg-yellow-500 text-white p-1 ml-2">Editar</a>
                        <button @click="deleteAnimal(animal.id)" class="bg-red-500 text-white p-1 ml-2">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
