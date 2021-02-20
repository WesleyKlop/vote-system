<template>
    <div class="pt-2 rounded shadow text-center relative flex flex-wrap">
        <span class="ml-2">{{ number }}.</span>
        <span class="flex-1"></span>
        <span :title="usedAt" class="badge mr-2" v-if="usedAt">{{
            $t('Used')
        }}</span>
        <span class="uppercase font-mono w-full mt-2">{{
            formattedToken
        }}</span>
        <div class="card-footer p-2 w-full">
            <a
                :href="deleteRoute"
                @click="handleDeleteClick"
                class="card-footer-link"
                >{{ $t('Delete') }}</a
            >
        </div>
    </div>
</template>

<script>
import { formatToken } from '../helpers'

export default {
    props: {
        number: {
            type: Number,
            required: true,
        },
        usedAt: {
            type: Date,
            required: false,
            default: null,
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
            return formatToken(this.token)
        },
    },
    methods: {
        handleDeleteClick($event) {
            if (this.usedAt !== null && !confirm(this.$t(this.confirmText))) {
                $event.preventDefault()
            }
        },
    },
}
</script>

<style scoped></style>
