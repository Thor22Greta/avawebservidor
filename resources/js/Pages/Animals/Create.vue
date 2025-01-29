<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const form = ref({
    name: "",
    raza: "",
    chip: "",
    age: "",
    user_id: 1, // Reemplazar con usuario actual
    adopted: null,
    poster_image_url: "",
});

const submit = () => {
    router.post("/animals", form.value);
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold">Agregar Animal</h1>
        <form @submit.prevent="submit" class="mt-4">
            <input v-model="form.name" placeholder="Nombre" class="border p-2 w-full mb-2" required />
            <input v-model="form.raza" placeholder="Raza" class="border p-2 w-full mb-2" required />
            <input v-model="form.chip" placeholder="Chip (opcional)" class="border p-2 w-full mb-2" />
            <input v-model="form.age" type="number" placeholder="Edad" class="border p-2 w-full mb-2" required />
            <input v-model="form.poster_image_url" placeholder="URL de la imagen" class="border p-2 w-full mb-2" />
            <button type="submit" class="bg-green-500 text-white p-2">Guardar</button>
        </form>
    </div>
</template>
