<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                    <div class="max-w-sm w-3/4 lg:max-w-full lg:flex">
                        <div v-if="user.profile_photo_path==null" class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/images/profile.png')" title="Woman holding a mug"></div>
                        <div v-else class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" :style="{ backgroundImage: `url('/images/users/${user.profile_photo_path}')` }" title="Woman holding a mug"></div>

                        <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                            <div class="mb-8">
                                <p class="text-lg text-gray-600 flex items-center">
                                    Profil
                                </p>
                                <hr>
                                <div class="grid grid-cols-2 mt-2 gap-1">
                                    <div class="text-gray-900 font-bold text-md">Nama Lengkap</div>
                                    <div> : {{ user.name}}</div>
                                    <div class="text-gray-900 font-bold text-md">E-Mail</div>
                                    <div> : {{ user.email}}</div>
                                    <div class="text-gray-900 font-bold text-md">Role</div>
                                    <div> : {{ user.is_admin == 0 ? 'Customer' : 'Admin' }}</div>
                                    <div class="text-gray-900 font-bold text-md">Status</div>
                                    <div><span v-if="user.is_approved == 0" class="px-2 py-1 rounded-full text-gray-500 bg-gray-200 font-semibold text-sm flex align-center w-max cursor-pointer transition duration-300 ease">
                                         Not Approved
                                    </span>
                                        <span v-else class="px-4 py-2 rounded-full text-white bg-green-400 font-semibold text-sm flex align-center w-max cursor-pointer transition duration-300 ease">
                                         Approved
                                </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: {
        user: Object,
    },
    components: {
        AppLayout,
    },
}
</script>
