<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                    <table class="text-left w-3/4 border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                        <thead>
                        <tr>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Detail Customer</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light font-bold bg-gray-50">Nama Lengkap</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                {{ user.name }}
                            </td>
                        </tr>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light font-bold bg-gray-50">E-Mail</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                {{ user.email }}
                            </td>
                        </tr>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light font-bold bg-gray-50">Role</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                {{ user.is_admin == 0 ? 'Customer' : 'Admin' }}
                            </td>
                        </tr>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light font-bold bg-gray-50">Status</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <span v-if="user.is_approved == 0" class="px-2 py-1 rounded-full text-gray-500 bg-gray-200 font-semibold text-sm flex align-center w-max cursor-pointer transition duration-300 ease">
                                         Not Approved
                                    </span>
                                <span v-else class="px-4 py-2 rounded-full text-white bg-green-400 font-semibold text-sm flex align-center w-max cursor-pointer transition duration-300 ease">
                                         Approved
                                </span>
                            </td>
                        </tr>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light font-bold bg-gray-50">Dibuat Pada</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                {{ user.created_at | parse_date }}
                            </td>
                        </tr>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light font-bold bg-gray-50">Terakhir diubah</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                {{ user.updated_at | parse_date  }}
                            </td>
                        </tr>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light font-bold bg-gray-50">Action</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <jet-button @click.native="openModal()">
                                    Edit
                                </jet-button>
                                <jet-button v-if="user.is_approved == 0" @click.native="approveUser(user.id)">
                                    Approve
                                </jet-button>
                                <jet-button v-else :class="{ 'opacity-25': true }" :disabled="true">
                                    Approved
                                </jet-button>
                                <jet-button :class="'btn-danger'" @click.native="hapusUser(user.id)">
                                    Hapus
                                </jet-button>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <jet-dialog-modal :show="showNewUserModal" @close="closeModal">
            <template #title>
                Edit User
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
                    Update
                </jet-button>
            </template>
        </jet-dialog-modal>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetButton from "@/Jetstream/Button";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetLabel from "@/Jetstream/Label";

export default {
    props: {
        user: Object,
    },
    components: {
        AppLayout,
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton,
        JetLabel
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
            this.form.reset('password');
            this.form.errors = [];
            this.showNewUserModal = true;
            this.form.name = this.user.name;
            this.form.email = this.user.email;
            this.form.is_admin = this.user.is_admin;
            this.form.errors = [];
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
        hapusUser(id){
            this.$swal.fire({
                icon: 'error',
                title: 'Apakah Anda yakin ingin menghapus user?',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.$inertia.delete(route('user.delete', id));
                }
            })
        },
        saveUser() {
                this.form.put(this.route('user.update', this.user.id), {
                    preserveScroll: true,
                    errorBags: 'saveUser',
                    onFinish: () => {
                        if (Object.keys(this.form.errors).length === 0) {
                            this.$swal.fire({
                                icon: 'success',
                                title: 'User berhasil diupdate!'
                            })
                            this.form.reset('email', 'is_admin', 'password', 'name');
                            this.closeModal();
                            this.editMode = false;
                        } else {
                            this.$swal.fire({
                                icon: 'error',
                                title: 'User gagal diupdate!'
                            })
                        }
                    },
                })

        }
    }
}
</script>
