<script setup>
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';

const searchInput = ref('');
const customers = reactive({});

const searchCustomers = async() => {
    await axios.get('/api/searchCustomers', {
        params: {'search': searchInput.value}
    })
    .then(response => {
        console.log(response.data);
        customers.value = response.data;
        openDialog();
    }).catch(error => {
        console.error(error);
    })
}

onMounted(() => {
    axios.get('/api/user')
    .then((res) => {
        console.log(res);
    })
})

const isShow = ref(false);

const openDialog = () => {
    isShow.value = !isShow.value
};

const emit = defineEmits(['update:customerId']);

const setCustomer = (e) => {
    searchInput.value = e.kana;
    emit('update:customerId', e.id);
    openDialog();
}
</script>

<style scoped>
.modal__container {
    height: 80vh;
}
</style>

<template>
    <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container w-4/5" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-1-title">
                        顧客検索
                    </h2>
                    <button @click="openDialog" type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <table class="mt-4 table-auto w-full text-left whitespace-no-wrap" v-if="customers.value">
                      <thead>
                        <tr>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                            Id
                          </th>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            氏名
                          </th>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            カナ
                          </th>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            電話番号
                          </th>
                          <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="hover:bg-gray-200 hover:cursor-pointer" v-for="customer in customers.value.data" :key="customer.id" @click="setCustomer({id: customer.id, kana: customer.kana})">
                          <td class="px-4 py-3">{{ customer.id }}</td>
                          <td class="px-4 py-3">{{ customer.name }}</td>
                          <td class="px-4 py-3">{{ customer.kana }}</td>
                          <td class="px-4 py-3">{{ customer.tel }}</td>
                        </tr>
                      </tbody>
                    </table>
                    <p v-else>
                        該当する顧客が見つかりませんでした。
                    </p>
                </main>
                <footer class="modal__footer">
                    <button @click="openDialog" type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">閉じる</button>
                </footer>
            </div>
        </div>
    </div>
    <div class="flex justify-between">
        <input type="text" v-model="searchInput" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        <button @click="searchCustomers" data-micromodal-trigger="modal-1" href='javascript:' class="w-2/5 bg-blue-400 rounded text-white ml-4">検索する</button>
    </div>
</template>