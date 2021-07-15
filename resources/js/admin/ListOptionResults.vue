<template>
    <div class='card-content'>
        <h3 class='sub-title'>{{ question.option }}</h3>
        <p class='text-xs text-gray-500'>{{ $t('At least x votes are required to pass', { x: votesThreshold })}}</p>
        <list-result-option
            v-for='option of choices'
            :key='option.id'
            :option='option.option'
            :count='option.votes'
            :total='totalVotesWithoutAbstain'
            :is-winning='isWinning(option)'
            :show-bar='option.id !== abstainId'
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
        blank() {
            return this.choices.find((o) => o.id === this.blankId)
        },
        abstain() {
            return this.choices.find((o) => o.id === this.abstainId)
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
        totalVotesWithoutAbstain() {
            let totalVotes = this.totalVotes
            if (this.abstain) {
                totalVotes -= this.abstain.votes
            }
            return totalVotes
        },
        votesThreshold() {
            return Math.ceil(this.totalVotesWithoutAbstain / 2)
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
            return option.votes > this.votesThreshold
        },
    },
}
</script>
