<template>
    <div class="pt-2 rounded shadow text-center relative flex flex-wrap">
        <span class="ml-2">{{ number }}.</span>
        <span class="flex-1"></span>
        <span :title="used_at" class="badge mr-2" v-if="used_at">used</span>
        <span class="uppercase font-mono w-full mt-2">{{
            formattedToken
        }}</span>
        <div class="card-footer p-2 w-full">
            <a
                :href="deleteRoute"
                @click="handleDeleteClick"
                class="card-footer-link"
                >Delete</a
            >
        </div>
    </div>
</template>

<script>
export default {
    name: 'TokenCard',
    props: {
        number: {
            type: String,
            required: true,
        },
        used_at: {
            type: Date,
        },
        token: {
            type: String,
            required: true,
        },
        deleteRoute: {
            type: String,
            required: true,
        },
        confirmText: {
            type: String,
            required: false,
            default: 'Are you sure you want to delete a used token?',
        },
    },
    computed: {
        formattedToken() {
            return this.token.match(/.{1,4}/g).join(' ')
        },
    },
    methods: {
        handleDeleteClick($event) {
            if (this.used_at !== null && !confirm(this.confirmText)) {
                $event.preventDefault()
            }
        },
    },
}
</script>

<style scoped></style>
