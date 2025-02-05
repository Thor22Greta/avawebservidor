<script setup>
import { defineProps, ref } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue"; // Importa el layout

const props = defineProps(["animal"]);

// Crear un formulario con los datos actuales del animal
const form = ref({
    name: props.animal.name,
    raza: props.animal.raza,
    chip: props.animal.chip,
    age: props.animal.age,
    user_id: props.animal.user_id,
    adopted: props.animal.adopted,
    poster_image_url: props.animal.poster_image_url,
});

const submit = () => {
    router.put(`/animals/${props.animal.id}`, form.value);
};
</script>

<template>
    <AppLayout title="Editar Animal">
        <template #header>
            <h1 class="text-2xl font-bold text-green-600 p-2">Editar Animal</h1>
        </template>

        <div class="p-6">
            <form @submit.prevent="submit" class="space-y-4">
                <input 
                    v-model="form.name" 
                    placeholder="Nombre" 
                    class="border border-green-600 p-2 w-full mb-2" 
                    required 
                />
                <input 
                    v-model="form.raza" 
                    placeholder="Raza" 
                    class="border border-green-600 p-2 w-full mb-2" 
                    required 
                />
                <input 
                    v-model="form.chip" 
                    placeholder="Chip (opcional)" 
                    class="border border-green-600 p-2 w-full mb-2" 
                />
                <input 
                    v-model="form.age" 
                    type="number" 
                    placeholder="Edad" 
                    class="border border-green-600 p-2 w-full mb-2" 
                    required 
                />
                <input 
                    v-model="form.poster_image_url" 
                    placeholder="URL de la imagen" 
                    class="border border-green-600 p-2 w-full mb-2" 
                />

                <button 
                    type="submit" 
                    class="bg-green-600 text-white p-2 hover:bg-green-500 w-full mt-4"
                >
                    Actualizar
                </button>

                <a 
                    href="/animals" 
                    class="bg-red-500 text-white p-2 hover:bg-red-400 w-full mt-4 block text-center"
                >
                    Cancelar
                </a>
            </form>
        </div>
    </AppLayout>
</template>
