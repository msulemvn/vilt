<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Me" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Me</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-red-500 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-2">
                    <div class="p-6 text-white dark:text-gray-100">
                        <p class="mt-2">This is a simple test to verify Tailwind is working.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
