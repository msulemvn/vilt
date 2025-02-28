<script setup>
import { defineProps, ref } from "vue";
const props = defineProps({
    users: {
        type: Array,
        required: true,
    },
    actions: {
        type: Array,
        required: false,
        default: [],
    },
});

const users = ref(props.users);
const columns = users.value && users.value.length > 0 
    ? [...Object.keys(users.value[0]), "actions"].map((key) =>
        _.startCase(_.toLower(key))
      )
    : [""];

</script>

<template>
    <div
        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
    >
        <div
            class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-2"
        >
            <table class="min-w-full table-auto">
                <tr>
                    <th
                        v-for="(head, index) in columns"
                        class="px-4 py-2 text-left"
                    >
                        {{ head }}
                    </th>
                </tr>
                <slot name="rowData"> </slot>
            </table>
        </div>
    </div>
</template>
