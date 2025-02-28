<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({
    posts: {
        type: Array
    }
})
</script>

<template>

    <Head title="Posts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">GET posts</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">
                    GET Posts
                </h3>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-2">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Name</th>
                                    <th class="px-4 py-2 text-left">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(account) in props.users" :key="account.id">
                                    <td class="px-4 py-2">{{ account.id }}</td>
                                    <td class="px-4 py-2">{{ account.name }}</td>
                                    <td class="px-4 py-2">{{ account.email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>