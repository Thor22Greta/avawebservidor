<script setup>
import { defineProps, reactive, computed } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout

const props = defineProps(["animals"]);

// Propiedad reactiva para la búsqueda
const state = reactive({
    searchQuery: ''
});

// Función para eliminar un animal
const deleteAnimal = (id) => {
    if (confirm("¿Estás seguro?")) {
        router.delete(`/animals/${id}`);
    }
};

// Filtrado de animales según el searchQuery
const filteredAnimals = computed(() => {
    if (!state.searchQuery) return props.animals;

    return props.animals.filter((animal) => {
        return (
            animal.name.toLowerCase().includes(state.searchQuery.toLowerCase()) ||
            animal.raza.toLowerCase().includes(state.searchQuery.toLowerCase()) ||
            animal.age.toString().includes(state.searchQuery)
        );
    });
});
</script>

<template>
    <AppLayout title="Animales">
        <template #header>
            <h1 class="text-2xl font-bold text-green-600 p-2">Animales</h1>
        </template>

        <!-- Campo de búsqueda -->
        <div class="p-4">
            <input
                v-model="state.searchQuery"
                type="text"
                placeholder="Buscar animal por nombre, raza o edad..."
                class="border border-green-300 p-2 w-1/2 rounded"
            />
        </div>

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
                    <tr v-for="animal in filteredAnimals" :key="animal.id">
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
