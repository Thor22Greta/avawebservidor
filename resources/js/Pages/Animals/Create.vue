<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const form = ref({
    name: "",
    raza: "",
    chip: "",
    age: "",
    user_id: 1, 
    adopted: null,
    poster_image_url: "",
});

const submit = () => {
    router.post("/animals", form.value);
};
</script>

<template>
        <div class="p-6">
            <h1 class="text-2xl font-bold text-green-600">Agregar Animal</h1>
            <form @submit.prevent="submit" class="mt-4">
                <input v-model="form.name" placeholder="Nombre" class="border border-green-600 p-2 w-full mb-2" required />
                <input v-model="form.raza" placeholder="Raza" class="border border-green-600 p-2 w-full mb-2" required />
                <input v-model="form.chip" placeholder="Chip (opcional)" class="border border-green-600 p-2 w-full mb-2" />
                <input v-model="form.age" type="number" placeholder="Edad" class="border border-green-600 p-2 w-full mb-2" required />
                <input v-model="form.poster_image_url" placeholder="URL de la imagen" class="border border-green-600 p-2 w-full mb-2" />
                <button type="submit" class="bg-green-600 hover:bg-green-500 text-white p-2 w-full mt-4">Guardar</button>
            </form>
        </div>
</template>
