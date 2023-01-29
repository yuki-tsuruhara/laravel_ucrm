<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import FlashValidation from "@/Components/FlashValidation.vue";
import Pagination from '@/Components/Pagination.vue'
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import dayjs from 'dayjs';

const props = defineProps({
  orders: Object
})

// const search = ref('')

// const searchCustomers = () => {
//     Inertia.get(route('customers.index', {search: search.value}))
// }
</script>

<template>
  <div>
    <Head title="購買履歴"></Head>

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">購買履歴</h2>
      </template>


      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <section class="text-gray-600 body-font">
                <div class="container px-5 py-8 mx-auto">
                  <FlashValidation />
                  <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                    <!-- <div>
                        <input class="rounded" type="text" name="search" v-model="search">
                        <button class="rounded ml-4 bg-blue-300 text-white py-2 px-4" @click="searchCustomers">検索</button>
                    </div> -->
                    <!-- <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                      <Link class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded" as="button" :href="route('customers.create')">購買履歴</Link>
                    </div> -->
                    <table class="mt-4 table-auto w-full text-left whitespace-no-wrap">
                      <thead>
                        <tr>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                            Id
                          </th>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            顧客名
                          </th>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            合計
                          </th>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            ステータス
                          </th>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            購入日時
                          </th>
                          <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="order in props.orders.data" :key="order.id">
                          <td class="px-4 py-3">
                            <Link class="text-blue-400" :href="route('purchase.show', {purchase: order.id})">
                                {{ order.id }}
                            </Link>
                        </td>
                          <td class="px-4 py-3">{{ order.customer_name }}</td>
                          <td class="px-4 py-3">{{ order.total }}</td>
                          <td class="px-4 py-3">{{ order.status }}</td>
                          <td class="px-4 py-3">{{ dayjs(order.created_at).format('YYYY-MM-DD HH:mm:ss') }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <Pagination class="mt-6" :links="props.orders.links"></Pagination>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </div>
</template>
