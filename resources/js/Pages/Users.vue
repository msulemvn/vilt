<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";
import MyTable from "@/Components/MyTable.vue";
import { ref, reactive, toRaw } from "vue";
import MyDialog from "@/Components/MyDialog.vue";
import _ from "lodash";
import { router } from '@inertiajs/vue3'

const buttonLabel = ref("Create");
const props = defineProps({
    users: {
        type: Object,
    },
});

let users = reactive(props.users.data);

function handleOnCreate(data) {
    const nextId = users.length > 0 
        ? Math.max(...users.map(user => user.id)) + 1 
        : 1;

    users.push({
        ...data,
        id: nextId
    });
}

function handleOnEdit(data) {
    const index = users.findIndex(user => user.id === data.id);
    
    if (index !== -1) {
        users[index] = {
            ...users[index],
            ...data
        };
    } else {
        console.error('User not found!');
    }
}

const edit = (row) => {
    buttonLabel.value = "Edit";
};
const add = () => {
    buttonLabel.value = "Create";
};

function removeAndReindex(users, indexToRemove) {
    delete users[indexToRemove];
    //reindexing
    users = Object.values(users);
    console.log(JSON.stringify(users));
    return users;
}

const deleteRow = (rowIndex, user) => {
    axios({
        method: "delete",
        url: `/users/${user.id}`,
        responseType: "json",
    }).then(function (response) {
        if (response.data.status === "OK") {
            router.visit('/users', {preserveScroll: true});
            // users = { ... removeAndReindex(users, rowIndex) };
        }
    });
};

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Users
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h3
                    class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4"
                >
                    Users
                </h3>
                <div
                    class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-2"
                >
                    <MyDialog :buttonLabel="buttonLabel" @onCreate="handleOnCreate" @onEdit="handleOnEdit">
                        <template #trigger>
                            <Button
                                class="float-right"
                                @click="add"
                                variant="outline"
                            >
                                <FontAwesomeIcon icon="user" class="pr-2" /> Add
                                User
                            </Button>
                        </template>
                    </MyDialog>
                </div>
                <MyTable :users="users">
                    <template #rowData>
                        <tr
                            v-for="(row, rowIndex) in users"
                            :key="rowIndex"
                        >
                            <td
                                v-for="(cell, cellIndex) in row"
                                class="px-4 py-2"
                            >
                                {{ cell }}
                            </td>
                            <td class="px-4 py-2">
                                <MyDialog
                                    :user="row"
                                    :buttonLabel="buttonLabel"
                                    @onCreate="handleOnCreate" @onEdit="handleOnEdit"
                                >
                                    <template #trigger>
                                        <Button
                                            variant="outline"
                                            @click="edit(row)"
                                        >
                                            <FontAwesomeIcon
                                                icon="pencil"
                                                class="pr-2"
                                            />Edit
                                        </Button>
                                    </template>
                                </MyDialog>
                                <Button
                                    variant="outline"
                                    @click="deleteRow(rowIndex, row)"
                                    class="ml-1"
                                >
                                    <FontAwesomeIcon
                                        icon="trash"
                                        class="pr-2"
                                    />Delete
                                </Button>
                            </td>
                        </tr>
                    </template>
                </MyTable>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
