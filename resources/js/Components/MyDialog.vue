<script setup lang="ts">
import { Button } from "@/Components/ui/button";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/Components/ui/dialog";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";  
import { toTypedSchema } from "@vee-validate/zod";
import { useForm } from "vee-validate";
import { h, reactive, ref, defineEmits } from "vue";
import * as z from "zod";
import axios from "axios";
import { router } from '@inertiajs/vue3'

const props = defineProps({
    user: {
        type: Object,
        default: {},
        required: false,
    },
    buttonLabel: {
        type: String,
    },
});

const emit = defineEmits(['onCreate', 'onEdit']);

const user = reactive(Object.assign({}, props.user));

const isDialogOpen = ref(false);

const formSchema = toTypedSchema(
    z.object({
        name: z
            .string()
            .min(2, { message: "Name must be at least 2 characters long." })
            .max(50, { message: "Name must not exceed 50 characters." }),
        email: z
            .string()
            .email({ message: "Please enter a valid email address." }),
    }),
);

const { handleSubmit, errors } = useForm({
    validationSchema: formSchema,
    initialValues: user,
});

const onSubmitForm = (event: SubmitEvent) => {
    const formData = new FormData(event.target as HTMLFormElement);
    axios({
        method: props.buttonLabel == "Create" ? "post" : "put",
        url: `/users${props.buttonLabel == "Create" ? "" : "/" + user.id}`,
        data: Object.fromEntries(formData),
        responseType: "json",
    }).then(function (response) {
        // props.buttonLabel == "Create" ? emit('onCreate', response.data.data) : emit('onEdit', response.data.data);
        router.visit('/users', {preserveScroll: true});
    });
    isDialogOpen.value = false;
};
</script>

<template>
    <Dialog v-model:open="isDialogOpen">
        <DialogTrigger as-child>
            <slot name="trigger" />
        </DialogTrigger>
        <DialogContent class="sm:max-w-[425px]">
            <form @submit.prevent="onSubmitForm">
                <DialogHeader>
                    <DialogTitle>{{ props.buttonLabel }}</DialogTitle>
                    <DialogDescription>
                        Make changes to your profile here. Click save when
                        you're done.
                    </DialogDescription>
                </DialogHeader>
                <div class="grid gap-4 py-4">
                    <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="name" class="text-right"> Name </Label>
                        <Input
                            id="name"
                            name="name"
                            :default-value="user.name"
                            class="col-span-3"
                        />
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="email" class="text-right"> Email </Label>
                        <Input
                            id="email"
                            name="email"
                            :default-value="user.email"
                            class="col-span-3"
                        />
                    </div>
                </div>
                <DialogFooter>
                    <Button type="submit"> Save changes </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>