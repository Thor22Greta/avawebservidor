<script setup>
import ApplicationLogo from '@/Components/ApplicationMark.vue';
import { usePage } from '@inertiajs/vue3';
const { props: pageProps } = usePage();
</script>

<template>
    <div>
        <!-- Sección de encabezado -->
        <div class="p-6 lg:p-8 bg-white border-b border-green-600 text-center">
            <ApplicationLogo class="w-32 h-32 mx-auto" />
            <h1 class="mt-4 text-3xl font-bold text-green-600">
                Bienvenido {{ pageProps.auth.user.name }} a Animalistes Vall d’Albaida
            </h1>
            <p class="mt-2 text-xl text-gray-600">Luchando por el bienestar animal</p>
            <!-- Enlace a Instagram -->
            <p class="mt-4">
                    <a href="https://www.instagram.com/animalistesvalldalbaida/" 
                       class="inline-flex items-center font-semibold text-green-600" target="_blank">
                        Visítanos en Instagram
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </p>
            <p class="mt-4">
                    <a href="https://www.facebook.com/p/Animalistes-Vall-dAlbaida-61557054398851/?locale=ca_ES" 
                       class="inline-flex items-center font-semibold text-green-600" target="_blank">
                        Visítanos en Facebook
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </p>
        </div>

        <!-- Sección de objetivos -->
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div>
                <h2 class="text-2xl font-semibold text-green-600">🎯 Nuestro objetivo</h2>
                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    Llevar a la práctica la Ley de Bienestar Animal para proteger y mejorar las condiciones de vida de los animales.
                </p>
            </div>

            <!-- Sección de lucha por los animales -->
            <div>
                <h2 class="text-2xl font-semibold text-green-600">🐶 Luchando por los animales</h2>
                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    Estamos comprometidos con la defensa de los derechos de los animales y trabajamos activamente para darles una vida mejor.
                </p>
            </div>
        </div>

        <!-- Sección de donaciones -->
        <div class="bg-white p-6 lg:p-8 mt-6 border-t border-gray-200">
            <h2 class="text-2xl font-semibold text-green-600">💚 Cuenta de Donaciones</h2>
            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                Tu apoyo es fundamental para continuar con nuestra misión. Puedes realizar una donación a través de la siguiente cuenta:
            </p>
            <p class="mt-2 font-semibold text-gray-900">
                ES73 0049 3376 5323 1411 7493
            </p>
            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                También puedes colaborar a través de nuestro perfil de Tiendanimal:
            </p>
            <p class="mt-2">
                <a href="https://www.tiendanimal.es/servicios/adopta-con-tiendanimal/protectora/perfil/valencia/animalistes-vall-d'albaida/380?srsltid=AfmBOoq2-G5QOxByxQ2G6SJKi36sWH2U27Vlv1LnsFC-pD1KpMdc0cPK" 
                   class="inline-flex items-center font-semibold text-green-600" target="_blank">
                    Consulta aquí todos nuestros animales en adopción

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500">
                        <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                    </svg>
                </a>
            </p>
        </div>
    </div>
</template>
