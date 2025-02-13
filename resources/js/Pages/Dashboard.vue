<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import axios from 'axios';

// Variable para el modo oscuro
const isDarkMode = ref(false);

// Función para obtener las preferencias del usuario desde el backend
const getUserPreferences = async () => {
    try {
        // Llamar al backend para obtener las preferencias del usuario
        const response = await axios.get('/user/preferences');
        isDarkMode.value = response.data.dark_mode;
        document.body.classList.toggle('dark', isDarkMode.value);
    } catch (error) {
        console.error('Error al obtener las preferencias del usuario', error);
    }
};

// Función para alternar entre modo oscuro y claro
const toggleDarkMode = async () => {
    isDarkMode.value = !isDarkMode.value;

    // Cambiar el cuerpo del documento entre modo oscuro y claro
    document.body.classList.toggle('dark', isDarkMode.value);

    // Enviar la preferencia al backend
    try {
        await axios.post('/user/preference/dark-mode', { dark_mode: isDarkMode.value });
        console.log('Preferencia de modo oscuro actualizada');
    } catch (error) {
        console.error('Error al actualizar la preferencia', error);
    }
};

// Cargar las preferencias del usuario al montar el componente
onMounted(() => {
    getUserPreferences();
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Home
                </h2>
                <!-- Botón para alternar entre Modo Oscuro y Modo Claro -->
                <div class="flex items-center space-x-4">
                    <label for="darkModeSwitch" class="text-sm font-medium"></label>
                    <button
                        @click="toggleDarkMode"
                        class="px-4 py-2 bg-gray-600 text-white rounded"
                    >
                        {{ isDarkMode ? 'Modo Claro' : 'Modo Oscuro' }}
                    </button>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
/* Estilos comunes para modo claro y oscuro */

/* Fondo y color de texto */
body {
  transition: background-color 0.3s, color 0.3s;
}

.dark body {
  background-color: #2c3e50; /* Fondo oscuro */
  color: #ecf0f1; /* Texto claro */
}

/* Estilos de los botones */
button {
  background-color: #28a745; /* Botón verde en modo claro */
  color: white;
}

.dark button {
  background-color: #16a085; /* Botón verde en modo oscuro */
}

/* Campos de formulario */
input, select, textarea {
  background-color: #fff;
  color: #333;
  border-color: #ddd;
}

.dark input, .dark select, .dark textarea {
  background-color: #34495e; /* Fondo oscuro en campos de formulario */
  color: #ecf0f1; /* Texto claro en campos de formulario */
  border-color: #7f8c8d;
}

/* Estilo del interruptor del modo oscuro */
input[type="checkbox"] {
  transition: background-color 0.3s ease;
}

input[type="checkbox"]:checked {
  background-color: #4caf50;
}
</style>
