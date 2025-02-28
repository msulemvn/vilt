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
import { h, ref, defineEmits, onMounted, watch } from "vue";
import * as z from "zod";
import axios from "axios";

const props = defineProps({
    user: {
        type: Object,
        default: {},
        required: false,
    },
    operation: {
        type: String,
    },
    isDialogOpen: {
        type: Boolean,
    }
});

const emit = defineEmits(['onCreate', 'onEdit', 'onDialogClose']);

const user = ref(props.user);
const isDialogOpen = ref(props.isDialogOpen);

onMounted(()=>{});

watch(isDialogOpen, (current, previous)=>{
    if(current != previous) {
        emit('onDialogClose', current);
    }
});

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
    initialValues: user.value,
});

const onSubmitForm = (event: SubmitEvent) => {
    const formData = new FormData(event.target as HTMLFormElement);
    axios({
        method: props.operation == "Create" ? "post" : "put",
        url: `/users${props.operation == "Create" ? "" : "/" + user.value.id}`,
        data: Object.fromEntries(formData),
        responseType: "json",
    }).then(function (response) {
        props.operation == "Create" ? emit('onCreate', response.data.data) : emit('onEdit', response.data.data);
        isDialogOpen.value = false;
    });
};
</script>

<template>
    <Dialog v-model:open="isDialogOpen">
        <DialogContent class="sm:max-w-[425px]">
            <form @submit.prevent="onSubmitForm">
                <DialogHeader>
                    <DialogTitle>{{ props.operation }}</DialogTitle>
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