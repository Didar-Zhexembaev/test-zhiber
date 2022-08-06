<script setup>
const props = defineProps({
    loading: Boolean,
    text: String,
    type: String,
    class: String,
});
</script>
<template>
    <button
        :disabled="props.loading"
        :type="props.type"
        class="w-100 btn"
        :class="props.class"
    >
        <span v-show="props.loading" class="spinner-border spinner-border-sm mr-1"></span>
        {{ props.text }}
    </button>
</template>
