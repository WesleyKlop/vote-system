<template>
    <div class="card-content">
        <h3 class="sub-title">{{ question.option }}</h3>
        <list-result-option
            v-for="option of choices"
            :key="option.id"
            :option="option.option"
            :count="option.votes"
            :total="totalVotes"
            :is-winning="isWinning(option)"
        />
    </div>
</template>

<script>
import ListResultOption from './ListResultOption'

export default {
    components: { ListResultOption },
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
            return this.options
                .filter((o) => o.axis === 'vertical')
                .map((option) => ({
                    ...option,
                    votes: this.votes(option),
                }))
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
        optionWithMostVotes() {
            const sorted = this.choices
                .filter((o) => ![this.blankId, this.abstainId].includes(o.id))
                .sort((a, b) => Math.sign(b.votes - a.votes))
            // If they have the same amount of votes it's not decided.
            if (sorted.length > 1 && sorted[0].votes > sorted[1].votes) {
                return sorted[0]
            }
        },
    },
    methods: {
        votes(option) {
            return this.results[this.question.id]?.[option.id] ?? 0
        },
        isWinning(option) {
            if ([this.blankId, this.abstainId].includes(option.id)) {
                return false
            }
            return option.id === this.optionWithMostVotes?.id
        },
    },
}
</script>
