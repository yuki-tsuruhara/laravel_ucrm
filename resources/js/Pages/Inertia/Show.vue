<script setup>
import { Inertia } from "@inertiajs/inertia";
defineProps({
    id: Number,
    blog: Object,
});

const deleteBlog = (id) => {
    Inertia.delete(`/inertia/${id}`, {
        onBefore: () => confirm("削除しても良いですか？"),
    });
};
</script>
<template>
    <div>
        ルート番号は{{ id }}です
        <button @click="deleteBlog(blog.id)">削除</button>
    </div>
</template>
