<template>
    <div class="card-content">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th v-for="option of horizontal" :key="option.id">
                            {{ option.option }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <grid-option-results-row
                        v-for="rowOption of vertical"
                        :key="rowOption.id"
                        :row="rowOption"
                        :columns="horizontal"
                        :results="results"
                        :abstain-id="abstainId"
                        :blank-id="blankId"
                    />
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import GridOptionResultsRow from './GridOptionResultsRow'

export default {
    components: { GridOptionResultsRow },
    props: {
        options: {
            type: Array,
            required: true,
        },
        results: {
            type: Object,
            required: true,
        },
        blankId: { type: String, required: false, default: null },
        abstainId: { type: String, required: false, default: null },
    },
    computed: {
        vertical() {
            return this.options.filter((o) => o.axis === 'vertical')
        },
        horizontal() {
            return this.options.filter((o) => o.axis === 'horizontal')
        },
        totalVotes() {
            return 1
        },
    },
    methods: {
        votes(hor, ver) {
            return this.results[hor.id]?.[ver.id] ?? 0
        },
    },
}
</script>
