<template>
    <div
        v-if="$store.getters.flashMessage"
        class="alert alert-danger alert-dismissible fade show"
        role="alert"
    >
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>

        <strong>{{ $store.getters.flashMessage }}</strong>
    </div>
</template>
