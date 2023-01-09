<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import Label from '@/Components/InputLabel.vue'
import Input from '@/Components/TextInput.vue'

const emitTest = e => console.log(e)
</script>

<template>
    <GuestLayout>
        何か文字を書く
        <Label value="ラベル"></Label>
        <Input modelValue="モデル" @update:modelValue="emitTest"></Input>
    </GuestLayout>
</template>