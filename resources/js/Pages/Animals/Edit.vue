<script setup>
import { defineProps, ref } from "vue";
import { router } from "@inertiajs/vue3";

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
    <div class="p-6">
        <h1 class="text-2xl font-bold">Editar Animal</h1>
        <form @submit.prevent="submit" class="mt-4">
            <input v-model="form.name" placeholder="Nombre" class="border p-2 w-full mb-2" required />
            <input v-model="form.raza" placeholder="Raza" class="border p-2 w-full mb-2" required />
            <input v-model="form.chip" placeholder="Chip (opcional)" class="border p-2 w-full mb-2" />
            <input v-model="form.age" type="number" placeholder="Edad" class="border p-2 w-full mb-2" required />
            <input v-model="form.poster_image_url" placeholder="URL de la imagen" class="border p-2 w-full mb-2" />

            <button type="submit" class="bg-yellow-500 text-white p-2">Actualizar</button>
            <a href="/animals" class="bg-gray-500 text-white p-2 ml-2">Cancelar</a>
        </form>
    </div>
</template>
