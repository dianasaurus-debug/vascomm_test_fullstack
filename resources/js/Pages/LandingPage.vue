<template>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <span v-if="$page.props.user">
                <inertia-link v-if="$page.props.user.is_admin==1" :href="route('admin.dashboard')" :active="route().current('admin.dashboard')" class="text-sm text-gray-700 underline">
                Dashboard
            </inertia-link>
            <inertia-link v-else :href="route('customer.home')" :active="route().current('customer.home')" class="text-sm text-gray-700 underline">
                Home
            </inertia-link>
            </span>
            <template v-else>
                <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">
                    Login
                </inertia-link>

                <inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Register
                </inertia-link>
            </template>
        </div>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 lg:py-10">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">

                    <div class="flex justify-start items-center">
                        <img src="images/coffee_logo.png" class="object-fill h-40">
                        <div class="flex flex-col">
                            <p class="font-bold text-7xl">DiCafe</p>
                            <p class="text-sm">Drink coffee everywhere</p>
                        </div>

                    </div>

            </div>

            <div class="mt-5 bg-white overflow-hidden shadow sm:rounded-lg p-10">
                <div class="flex justify-center pt-8 sm:pt-0 mb-10">
                    <span class="font-bold text-2xl underline decoration-4">Our Coffees</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-y-6 gap-x-2">
                    <div  v-for="product in products" class="antialiased text-gray-900">
                        <div>
                            <img :src="product.img" alt=" random imgee" class="w-full object-cover object-center rounded-lg shadow-md">
                            <div class="relative px-4 -mt-16">
                                <div class="bg-white p-6 rounded-lg shadow-lg">
                                    <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate">{{product.nama}}</h4>

                                    <div class="mt-1">
                                        Rp {{product.harga}}
                                    </div>
                                    <div class="mt-4">
                                        <span class="text-sm text-gray-600">{{product.desc}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<style scoped>
.bg-gray-100 {
    background-color: #f7fafc;
    background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
    border-color: #edf2f7;
    border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
    color: #a0aec0;
    color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
    color: #718096;
    color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
    color: #4a5568;
    color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
    color: #1a202c;
    color: rgba(26, 32, 44, var(--tw-text-opacity));
}
.wrapper{
    display:grid;
    height:100vh;
    place-items:center
}

</style>

<script>
export default {
    data(){
        return {
            products : [
                {
                    nama : 'Vanilla Coffee',
                    img : 'images/products/vanilla.jpeg',
                    desc : 'Kopi dengan aroma vanilla yang kuat dan rasa yang mild',
                    harga : '20.000'
                },
                {
                    nama : 'Caramel Rum Coffee',
                    img : 'images/products/caramel.jpg',
                    desc : 'Kopi dengan campuran Rum dengan manisnya caramel',
                    harga : '30.000'
                },
                {
                    nama : 'Hazelnut Coffee',
                    img : 'images/products/hazelnut.jpg',
                    desc : 'Rasakan gurihnya Hazelnut di dalam kuatnya kopi',
                    harga : '25.000'

                },
                {
                    nama : 'Matcha Latte',
                    img : 'images/products/matcha.jpeg',
                    desc : 'Kopi dengan campuran matcha yang bikin relax',
                    harga : '35.000'

                },
                {
                    nama : 'Avocado Coffee',
                    img : 'images/products/avocado.jpg',
                    desc : 'Campuran alpukat creamy dengan kopi yang strong',
                    harga : '25.000'

                },
            ]
        }
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    }
}
</script>
