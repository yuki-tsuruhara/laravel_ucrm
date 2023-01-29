
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "vue";
import { computed, onMounted } from '@vue/runtime-core';
import { Inertia } from "@inertiajs/inertia";
import dayjs from 'dayjs';

onMounted(() => {
    console.log(props.items);
    console.log(props.order[0]);
})

const props = defineProps({
    'items': Array,
    'order': Array
})

</script>

<template>
    <Head title="購買履歴詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                購買履歴詳細
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
                                                    <div id="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        {{ dayjs(props.order[0].created_at).format('YYYY-MM-DD') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="customer" class="leading-7 text-sm text-gray-600">会員名</label>
                                                    <div id="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        {{ props.order[0].customer_name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <table class="w-full text-sm text-left text-black-400 dark:text-gray-700">
                                                    <thead class="text-xs text-black-700 uppercase bg-gray-50 dark:bg-gray-200 dark:text-gray-700">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3">Id</th>
                                                            <th scope="col" class="px-6 py-3">会員名</th>
                                                            <th scope="col" class="px-6 py-3">金額</th>
                                                            <th scope="col" class="px-6 py-3">数量</th>
                                                            <th scope="col" class="px-6 py-3">小計</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-300" v-for="item in props.items" :key="item.id">
                                                            <td class="px-6 py-4">{{ item.item_id }}</td>
                                                            <td class="px-6 py-4">{{ item.customer_name }}</td>
                                                            <td class="px-6 py-4">{{ item.item_price }}</td>
                                                            <td class="px-6 py-4">{{ item.quantity }}</td>
                                                            <td class="px-6 py-4">{{ item.subtotal }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div class="">
                                                    合計：{{ props.order[0].total }}
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="customer" class="leading-7 text-sm text-gray-600">ステータス</label>
                                                    <div id="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        <div class="" v-if="props.order[0].status">
                                                            未キャンセル
                                                        </div>
                                                        <div v-else class="">
                                                            キャンセル済み
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2 w-full" v-if="props.order[0].status">
                                                <div class="relative">
                                                    <label for="customer" class="leading-7 text-sm text-gray-600">キャンセル日時</label>
                                                    <div id="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        {{ dayjs(props.order[0].updated_at).format('YYYY-MM-DD') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2 w-full" v-if="props.order[0].status">
                                                <Link as="button" :href="route('purchase.edit', {purchase: props.order[0].id})" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集</Link>
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
