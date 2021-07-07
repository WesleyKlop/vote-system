<template>
    <div class="card">
        <component
            :is="`${type}-option-results`"
            :options="options"
            :results="results"
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
