<template>
    <div />
</template>

<script>
import echo from '../shared/websockets'

export default {
    props: {
        initialProposition: {
            type: Object,
            required: false,
            default: null,
        },
    },
    data() {
        return {
            proposition: this.initialProposition,
        }
    },
    mounted() {
        echo()
            .private('controls')
            .listen('PropositionChange', this.handlePropositionChange)
    },
    beforeDestroy() {
        echo()
            .private('controls')
            .stopListening('PropositionChange', this.handlePropositionChange)
    },
}
</script>
