<script setup>
import AuthenticatedLayout from '@/Layouts/Coordi/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import InputGroup from '@/Components/InputGroup.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    Reportes: {
        type: Array
    },
    roles: {
        type: Object
    }
});
const form = useForm({
    name: '',
    email: '',
    phone: '',
    password: '',
    role_id: '',
});

const v = ref({
    id: '',
    name: '',
    phone: '',
    password: '',
    programs: []
});

const showModalView = ref(false);
const showModalForm = ref(false);
const title = ref('');
const operation = ref(1);
const classMsj = ref('hidden');

const openModalView = (a) => {
    v.value.name = a.name;
    v.value.phone = a.phone;
    v.value.programs = a.programs;
    showModalView.value = true;
}
const openModalForm = (op, a) => {
    showModalForm.value = true;
    operation.value = op;
    form.clearErrors();
    if (op === 1) {
        title.value = 'Crear Coordinador';
    }
    else {
        title.value = 'Reportes ';
        form.name = a.name;
        form.email = a.email;
        v.value.id = a.id;
    }
}

const closeModalForm = () => {
    showModalForm.value = false;
    form.reset();
}
</script>
<template>

    <Head title="Reportes" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <span class="text-lg font-semibold">Reports</span>
                <button
                    class="ml-4 w-10 h-10 flex items-center justify-center bg-blue-500 text-white rounded-full hover:bg-blue-600"
                    @click="openModalForm">
                <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="2"
                        stroke="currentColor" 
                        class="w-6 h-6"
                >
                        <path 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                </button>
            </div>
        </template>

        <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md" :class="classMsj">
            <div class="flex justify-center items-center w-12 bg-green-500">
            <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke-width="1.5"
                    troke="currentColor" 
                    class="size-6"
            >
                    <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>

            
        </div>

        <div class="w-full overflow-hidden rounded-lg border shadow-md ">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Date of Shipment</th>
                            <th class="px-4 py-3">To:</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="coordi in Reportes" :key="coordi.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">{{ coordi.id }}</td>
                            <td class="px-4 py-3 text-sm">{{ coordi.description }}</td>
                            <td class="px-4 py-3 text-sm">{{ coordi.email }}</td>
                            <td class="px-4 py-3 text-sm">{{ coordi.phone }}</td>
                            <td class="px-4 py-3 text-sm">{{ new Date(coordi.created_at).toLocaleString() }}</td>
                            <td class="px-4 py-3 text-sm">{{ new Date(coordi.updated_at).toLocaleString() }}</td>
                            <td class="px-4 py-3 text-sm">
                                <SecondaryButton @click="openModalView(coordi)">
                                <svg 
                                        xmlns="http://www.w3.org/2000/svg" 
                                        fill="none" 
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5" 
                                        stroke="currentColor" 
                                        class="size-6"
                                >
                                        <path 
                                            stroke-linecap="round" 
                                            stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 
                                            9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path 
                                            stroke-linecap="round" 
                                            stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                </SecondaryButton>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <WarningButton @click="openModalForm(2, coordi)">
                                <svg 
                                        xmlns="http://www.w3.org/2000/svg" 
                                        fill="none" 
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5" 
                                        stroke="currentColor" 
                                        class="size-6"
                                    >
                                        <path 
                                        stroke-linecap="round" 
                                        stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 
                                        1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                                </WarningButton>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <DangerButton @click="openModalDel(coordi)">
                                <svg 
                                        xmlns="http://www.w3.org/2000/svg" 
                                        fill="none" 
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5" 
                                        stroke="currentColor" 
                                        class="size-6"
                                >
                                        <path 
                                            stroke-linecap="round" 
                                            stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 
                                            0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                </DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <Modal :show="showModalForm" @close="closeModalForm">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">{{ title }}</h2>
                <div class="mt-6 mb-6 space-y-6 max-w-xl">
                    <InputGroup :text="'Title'" :required="'required'" v-model="form.name" :type="'text'">
                    <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke-width="1.5"
                            stroke="currentColor" 
                            class="size-6"
                    >
                            <path 
                                stroke-linecap="round" 
                                stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 
                                12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.name"></InputError>

                    <InputGroup :text="'Date of shipment'" :required="'required'" v-model="form.email" :type="'email'">
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5"
                        stroke="currentColor" 
                        class="size-6"
                    >
                            <path 
                            stroke-linecap="round" 
                            stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 
                            2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.email"></InputError>
                </div>
            </div>
            <div class="m-6 flex justify-between">
                <PrimaryButton @click="save">Save</PrimaryButton>
                <SecondaryButton @click="closeModalForm">Cancel</SecondaryButton>
            </div>
        </Modal>
    </AuthenticatedLayout>

</template>