<script setup>
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    errors: Object
})

const form = reactive({
    title: null,
    content: null
})

const submitFunction = () => {
  Inertia.post('/inertia', form);
}
</script>
<template>
    <form action="" @submit.prevent="submitFunction">
        <input type="text" name="title" v-model="form.title">
        <p v-if="errors.title" class="text-red-500">{{ errors.title }}</p>
        <input type="text" name="content" v-model="form.content">
        <p v-if="errors.content" class="text-red-500">{{ errors.content }}</p>
        <button>送信</button>
    </form>
</template>