<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { computed, onMounted } from "@vue/runtime-core";
import { getToday } from "@/common";
import { reactive } from "vue";
import axios from "axios";
import dayjs from 'dayjs';
import Chart from "@/Components/Chart.vue";

onMounted(() => {
    form.startDate = getToday();
    form.endDate = getToday();
})

const form = reactive({
    startDate: null,
    endDate: null,
    type: 'perDay'
})

const data = reactive({});

const getData = async() => {
    await axios.get('/api/analysis', {
        params: {
            startDate: form.startDate,
            endDate: form.endDate,
            type: form.type
        }
    })
    .then(response => {
        data.data =response.data.data;
        data.labels =response.data.labels;
        data.totals =response.data.totals;
        console.log(response.data);
    })
    .catch(error => {
        console.log(error.message);
    })
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                データ分析
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="getData()">
                            <input type="date" name="startDate" v-model="form.startDate"> 〜
                            <input type="date" name="endDate" v-model="form.endDate">
                            <button class="ml-8 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">分析</button>
                        </form>
                        <Chart v-if="data.data" :data="data" />
                        <div v-if="data.data" class="w-full mx-auto overflow-auto">
                            <table class="mt-4 table-auto w-full text-left whitespace-no-wrap">
                                <thead class="bg-gray-300">
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm rounded-tl rounded-bl">
                                            日付
                                        </th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm">
                                            合計金額
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="even:bg-gray-100" v-for="data in data.data" :key="data.date">
                                        <td class="px-4 py-3">{{ dayjs(data.date).format('YYYY-MM-DD') }}</td>
                                        <td class="px-4 py-3">{{ data.total }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
