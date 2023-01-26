
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "vue";
import { computed, onMounted } from '@vue/runtime-core';
import { Inertia } from "@inertiajs/inertia";
import { getToday } from '@/common';
import MicroModal from "@/Components/MicroModal.vue";

onMounted(() => {
    form.date = getToday();
    props.items.forEach(item => {
        itemList.value.push({
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: 0
        })
    })
})

const itemList = ref([]);

const props = defineProps({
    'items': Array,
})

const form = reactive({
    date: null,
    customer_id: null,
    status: true,
    items: []
});

const storePurchase = () => {
    itemList.value.forEach(item => {
        if(item.quantity > 0) {
            form.items.push({
                id: item.id,
                quantity: item.quantity
            })
        }
    })

    Inertia.post(route('purchase.store'), form)
    form.items = []
}

const quantity = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

const totalPrice = computed(() => {
    let total = 0;
    itemList.value.forEach(item => {
        total += item.price * item.quantity;
    })
    return total;
})

const setCustomerId = (id) => {
    form.customer_id = id;
}
</script>

<template>
    <Head title="購入画面" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                購入画面
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <form @submit.prevent="storePurchase()">
                                <div class="container px-5 py-8 mx-auto">
                                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                        <div class="flex flex-wrap -m-2">
                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="date" class="leading-7 text-sm text-gray-600">日付</label>
                                                    <input type="date" name="date" id="date" v-model="form.date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="customer" class="leading-7 text-sm text-gray-600">会員名</label>
                                                    <MicroModal @update:customerId="setCustomerId"/>
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <table class="w-full text-sm text-left text-black-400 dark:text-gray-700">
                                                    <thead class="text-xs text-black-700 uppercase bg-gray-50 dark:bg-gray-200 dark:text-gray-700">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3">Id</th>
                                                            <th scope="col" class="px-6 py-3">商品名</th>
                                                            <th scope="col" class="px-6 py-3">金額</th>
                                                            <th scope="col" class="px-6 py-3">数量</th>
                                                            <th scope="col" class="px-6 py-3">小計</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-300" v-for="item in itemList" :key="item.id">
                                                            <td class="px-6 py-4">{{ item.id }}</td>
                                                            <td class="px-6 py-4">{{ item.name }}</td>
                                                            <td class="px-6 py-4">{{ item.price }}</td>
                                                            <td class="px-6 py-4">
                                                                <select name="quantity" v-model="item.quantity">
                                                                    <option v-for="q in quantity" :value="q" :key="q">{{ q }}</option>
                                                                </select>
                                                            </td>
                                                            <td class="px-6 py-4">{{ item.price * item.quantity }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div class="">
                                                    合計：{{ totalPrice }}
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>      
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
