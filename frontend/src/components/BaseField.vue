<script setup>
const props = defineProps({
    id: String,
    label: String,
    errors: String,
});
</script>
<template>
    <div class="form-row mb-3">
        <div class="form-group col">
            <label :for="props.id" class="form-label">{{ props.label }}</label>
            <slot />
            <div class="invalid-feedback">{{ props.errors }}</div>
            <slot name="end" />
        </div>
    </div>
</template>
