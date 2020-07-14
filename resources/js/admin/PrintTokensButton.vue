<template>
    <button type="button" class="submit-button" @click="showPrintDialog">
        Print
    </button>
</template>

<script>
import { printTokens } from './TokenPrintService'

export default {
    props: {
        tokens: {
            type: Array,
            required: true,
        },
    },
    methods: {
        showPrintDialog() {
            printTokens(this.tokens)
        },
    },
}
</script>
