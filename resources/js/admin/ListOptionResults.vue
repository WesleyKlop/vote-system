<template>
    <div class="card-content">
        <h3 class="sub-title">{{ question.option }}</h3>
        <list-result-option
            v-for="option of choices"
            :key="option.id"
            :option="option.option"
            :count="votes(option)"
            :total="totalVotes"
        />
    </div>
</template>

<script>
import ListResultOption from './ListResultOption'

export default {
    components: { ListResultOption },
    props: {
        options: {
            type: Array,
            required: true,
        },
        results: {
            type: Object,
            required: true,
        },
    },
    computed: {
        choices() {
            return this.options.filter((o) => o.axis === 'vertical')
        },
        question() {
            return this.options.find((o) => o.axis === 'horizontal')
        },
        totalVotes() {
            if (!this.results[this.question.id]) {
                return 0
            }
            return Object.values(this.results[this.question.id]).reduce(
                (total, curr) => total + curr,
                0,
            )
        },
    },
    methods: {
        votes(option) {
            return this.results[this.question.id]?.[option.id] ?? 0
        },
        percentage(option) {
            const votes = this.votes(option)
            if (votes === 0) {
                return 0
            }

            return (
                Math.round((votes / this.totalVotes) * 10000 + Number.EPSILON) /
                100
            )
        },
    },
}
</script>
