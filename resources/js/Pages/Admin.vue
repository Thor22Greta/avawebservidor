<script setup>
import { defineProps } from 'vue';

// Recibimos el token CSRF desde las props
const props = defineProps({
    users: Array,  // Recibimos los usuarios desde el backend
    user: Object,  // Recibimos el usuario autenticado
    csrfToken: String,  // Recibimos el token CSRF
    totals: Object,  // Recibimos los totales desde el backend
});
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
                    <!-- Solo mostrar la interfaz de administración si el usuario es admin -->
                    <div v-if="user && user.is_admin">
                        <div class="overflow-x-auto bg-white shadow-md rounded-lg mb-6">
                            <!-- Tabla de Totales -->
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

                        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-zinc-800">
                                        <th class="px-4 py-2 text-left">Nombre</th>
                                        <th class="px-4 py-2 text-left">Correo Electrónico</th>
                                        <th class="px-4 py-2 text-left">Estado</th>
                                        <th class="px-4 py-2 text-center">Acciones</th>
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
