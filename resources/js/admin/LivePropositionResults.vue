<template>
    <div class="card">
        <component
            :is="`${type}-option-results`"
            :options="options"
            :results="results"
            :blank-id='blankId'
            :abstain-id='abstainId'
        />
    </div>
</template>

<script>
import GridOptionResults from './GridOptionResults'
import ListOptionResults from './ListOptionResults'

export default {
    components: {
        ListOptionResults,
        GridOptionResults,
    },
    props: {
        abstainId: {
            type: String,
            required: false,
            default: null,
        },
        blankId: {
            type: String,
            required: false,
            default: null,
        },
        type: {
            type: String,
            required: true,
        },
        options: {
            type: Array,
            required: true,
        },
        results: {
            type: Object,
            required: false,
            default: () => ({}),
        },
    },
}
</script>
