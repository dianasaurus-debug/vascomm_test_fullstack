<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                    <div class="mb-6 flex justify-between items-center">
                        <jet-button @click.native="openModal" type="button">
                            Tambah User
                        </jet-button>
                    </div>
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold">
                            <th class="px-6 pt-6 pb-4">Nama Lengkap</th>
                            <th class="px-6 pt-6 pb-4">E-Mail</th>
                            <th class="px-6 pt-6 pb-4">Role</th>
                            <th class="px-6 pt-6 pb-4">Status</th>
                            <th class="px-6 pt-6 pb-4">Action</th>
                        </tr>
                        <tr v-for="user in users.data" :key="user.id"
                            class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">
                                <inertia-link class="px-6 py-4 flex items-center focus:text-green-500"
                                              :href="route('user.detail', user.id)">
                                    {{ user.name }}
                                </inertia-link>
                            </td>
                            <td class="border-t">
                                <inertia-link class="px-6 py-4 flex items-center" :href="route('user.detail', user.id)"
                                              tabindex="-1">
                                    {{ user.email }}
                                </inertia-link>
                            </td>
                            <td class="border-t">
                                <inertia-link class="px-6 py-4 flex items-center" :href="route('user.detail', user.id)"
                                              tabindex="-1">
                                    {{ user.is_admin == 0 ? 'Customer' : 'Admin' }}
                                </inertia-link>
                            </td>
                            <td class="border-t">
                                <inertia-link class="px-6 py-4 flex items-center" :href="route('user.detail', user.id)"
                                              tabindex="-1">
                                    <span v-if="user.is_approved == 0" class="px-2 py-1 rounded-full text-gray-500 bg-gray-200 font-semibold text-sm flex align-center w-max cursor-pointer transition duration-300 ease">
                                         Not Approved
                                    </span>
                                    <span v-else class="px-4 py-2 rounded-full text-white bg-green-400 font-semibold text-sm flex align-center w-max cursor-pointer transition duration-300 ease">
                                         Approved
                                    </span>
                                </inertia-link>
                            </td>
                            <td class="border-t">
                                <jet-button v-if="user.is_approved == 0" @click.native="approveUser(user.id)">
                                    Approve
                                </jet-button>
                                <jet-button v-else :class="{ 'opacity-25': true }" :disabled="true">
                                    Approved
                                </jet-button>
                            </td>
                        </tr>
                        <tr v-if="users.data.length === 0">
                            <td class="border-t px-6 py-4" colspan="4">No users found.</td>
                        </tr>
                    </table>
                    <pagination class="mt-6" :links="users.links"/>
                </div>
            </div>
        </div>
        <jet-dialog-modal :show="showNewUserModal" @close="closeModal">
            <template #title>
                Tambah User
            </template>

            <template #content>
                <div class="mt-2">
                    <jet-label value="Nama Lengkap"/>
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Masukkan Nama Lengkap"
                               v-model="form.name"/>
                    <jet-input-error :message="form.errors.name" class="mt-2"/>
                </div>
                <div class="mt-2">
                    <jet-label value="E-Mail"/>
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Masukkan E-Mail"
                               v-model="form.email"/>
                    <jet-input-error :message="form.errors.email" class="mt-2"/>
                </div>
                <div class="mt-3">
                    <jet-label value="Role User"/>
                    <select v-model="form.is_admin" class="form-select mt-1 block w-3/4 appearance-none px-3 py-1.5 text-base bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                        <option value="0">Customer</option>
                        <option value="1">Admin</option>
                    </select>
                    <jet-input-error :message="form.errors.is_admin" class="mt-2"/>
                </div>
                <div class="mt-2">
                    <jet-label for="password" value="Password"/>
                    <jet-input type="password" class="mt-1 block w-3/4" placeholder="Masukkan Password"
                               v-model="form.password"/>
                    <jet-input-error :message="form.errors.password" class="mt-2"/>
                </div>
            </template>
            <template #footer>
                <jet-secondary-button @click.native="closeModal">
                    Batal
                </jet-secondary-button>

                <jet-button @click.native="saveUser" class="ml-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                   Simpan
                </jet-button>
            </template>
        </jet-dialog-modal>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import JetButton from "@/Jetstream/Button";
import Pagination from "@/Shared/Pagination";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetLabel from "@/Jetstream/Label";

export default {
    props: {
        users: Object,
    },
    data() {
        return {
            showNewUserModal: false,
            form: this.$inertia.form({
                email: '',
                is_admin: 0,
                password: '',
                name: '',
            }),
        }
    },
    methods: {
        closeModal() {
            this.showNewUserModal = false;
        },
        openModal() {
            this.form.reset('email', 'is_admin', 'password', 'name');
            this.form.errors = [];
            this.showNewUserModal = true;
        },
        approveUser(id){
            this.$swal.fire({
                title: 'Apakah Anda ingin approve registrasi user?',
                showCancelButton: true,
                confirmButtonText: 'Approve',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.$inertia.put(route('user.approve', id));
                }
            })
        },
        saveUser(){
                this.form.post(this.route('user.store'), {
                    preserveScroll: true,
                    errorBags : 'saveUser',
                    onFinish:() => {
                        if (Object.keys(this.form.errors).length === 0) {
                            this.$swal.fire({
                                icon: 'success',
                                title: 'User berhasil ditambahkan!'
                            })
                            this.form.reset('email', 'is_admin', 'password', 'name');
                            this.closeModal();
                        } else {
                            this.$swal.fire({
                                icon: 'error',
                                title: 'User gagal ditambahkan!'
                            })
                        }
                    },
                })


        }
    },
    components: {
        AppLayout,
        Welcome,
        JetButton,
        Pagination,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton,
        JetLabel
    },
}
</script>
