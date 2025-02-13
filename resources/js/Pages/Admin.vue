<script setup>
import { defineProps, reactive, computed } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  users: Array,     // Recibimos los usuarios desde el backend
  user: Object,     // Recibimos el usuario autenticado
  csrfToken: String,// Recibimos el token CSRF
  totals: Object, 
  animals: Array  
});
// Estado para la búsqueda de animales
const state = reactive({
    searchQuery: ''
});

// Filtrar los animales según la búsqueda
const filteredAnimals = computed(() => {
    if (!state.searchQuery) return props.animals;
    return props.animals.filter(animal =>
        animal.name.toLowerCase().includes(state.searchQuery.toLowerCase()) ||
        animal.raza.toLowerCase().includes(state.searchQuery.toLowerCase()) ||
        animal.age.toString().includes(state.searchQuery)
    );
});

// Función para eliminar un animal
const deleteAnimal = (id) => {
    if (confirm("¿Estás seguro de que deseas eliminar este animal?")) {
        router.delete(`/animals/${id}`);
    }
};
</script>

<template>
  <div class="bg-gray-50 text-black dark:bg-black dark:text-white">
    <div class="min-h-screen flex flex-col items-center justify-center">
      <div class="w-full max-w-7xl px-6 py-10">
        <header class="flex items-center justify-between mb-6">
          <div class="flex items-center">
            <img src="images/Logo.jpg" alt="Logo de Administración" class="w-auto h-24 lg:h-32">
          </div>
        </header>

        <main>
          <!-- Mostrar la interfaz de administración solo si el usuario es admin -->
          <div v-if="user && user.is_admin">
            <!-- Tabla de Totales -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg mb-6">
              <h2 class="text-xl font-semibold mb-4">Totales</h2>
              <table class="w-full table-auto">
                <thead>
                  <tr class="bg-gray-100 dark:bg-zinc-800">
                    <th class="px-4 py-2 text-left">Usuarios</th>
                    <th class="px-4 py-2 text-left">Animales</th>
                    <th class="px-4 py-2 text-left">Eventos</th>
                    <th class="px-4 py-2 text-left">Donaciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b border-gray-200 dark:border-zinc-700">
                    <td class="px-4 py-2">{{ totals.users }}</td>
                    <td class="px-4 py-2">{{ totals.animals }}</td>
                    <td class="px-4 py-2">{{ totals.events }}</td>
                    <td class="px-4 py-2">{{ totals.donations }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- Tabla de Animales -->
<div class="overflow-x-auto bg-white shadow-md rounded-lg mt-6 p-4">
    <h2 class="text-xl font-semibold mb-4 text-green-600">Lista de Animales</h2>

    <!-- Campo de búsqueda -->
    <input
        v-model="state.searchQuery"
        type="text"
        placeholder="Buscar animal por nombre, raza o edad..."
        class="border border-green-300 p-2 w-1/2 rounded mb-4"
    />

    <table class="w-full table-auto border border-green-600">
        <thead>
            <tr class="bg-green-100">
                <th class="border border-green-600 p-2">Nombre</th>
                <th class="border border-green-600 p-2">Raza</th>
                <th class="border border-green-600 p-2">Edad</th>
                <th class="border border-green-600 p-2">Última Modificación</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="animal in filteredAnimals" :key="animal.id">
                <td class="border border-green-600 p-2">{{ animal.name }}</td>
                <td class="border border-green-600 p-2">{{ animal.raza }}</td>
                <td class="border border-green-600 p-2">{{ animal.age }}</td>
                <td class="border border-green-600 p-2">
                    {{ new Date(animal.updated_at).toLocaleString() }}
                </td>
            </tr>
        </tbody>
    </table>
</div>


            <!-- Tabla de Usuarios -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
              <table class="w-full table-auto">
                <thead>
                  <tr class="bg-gray-100 dark:bg-zinc-800">
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Correo Electrónico</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users" :key="user.id" class="border-b border-gray-200 dark:border-zinc-700">
                    <td class="px-4 py-2">{{ user.name }}</td>
                    <td class="px-4 py-2">{{ user.email }}</td>
                    <td class="px-4 py-2">
                      <span :class="user.status === 'activo' ? 'text-green-600' : 'text-red-600'">
                        {{ user.status === 'activo' ? 'Activo' : 'Bloqueado' }}
                      </span>
                    </td>
                    <td class="px-4 py-2 text-center">
                      <!-- Formulario para cambiar el estado del usuario -->
                      <form :action="'/admin/toggle-status/' + user.id" method="POST">
                        <input type="hidden" name="_token" :value="csrfToken" />
                        <input type="hidden" name="_method" value="PATCH" />
                        <button type="submit" 
                          class="px-4 py-2 bg-[#FF2D20] text-white rounded hover:bg-[#FF5733] transition duration-300">
                          {{ user.status === 'activo' ? 'Bloquear' : 'Desbloquear' }}
                        </button>
                      </form>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div v-else>
            <p class="text-xl text-center">No tienes permisos para gestionar usuarios.</p>
          </div>
        </main>
      </div>
    </div>
  </div>
</template>
