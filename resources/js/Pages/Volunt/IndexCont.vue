<script setup>
import AuthenticatedLayout from '@/Layouts/Volunt/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

// En los props van las variables que se reciben desde el controlador
const props = defineProps({
    users: {
		type: Array
	},
});

</script>

<template>
	<Head title="Voluntarios" />
	
	<AuthenticatedLayout>
		
		
		<div class="w-full overflow-hidden rounded-lg border shadow-md ">
			<div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">E-mail</th>
                            <th class="px-4 py-3">Role</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr v-for="user in users" :key="user.id" class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
									{{ user.id }}
								</td>
								<td class="px-4 py-3 text-sm">
									{{ user.name }}
								</td>
								<td class="px-4 py-3 text-sm">
									{{ user.phone }}
								</td>
                                <td class="px-4 py-3 text-sm">
									{{ user.email }}
								</td>
								<td class="px-4 py-3 text-sm">
                                    {{user.role.role }}
                                </td>
							</tr>
                    </tbody>
                </table>
            </div>
		</div>
	</AuthenticatedLayout>
</template>