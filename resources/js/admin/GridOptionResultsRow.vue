<template>
    <tr>
        <th>{{ rowOption.option }}</th>
        <td v-for="colOption of horizontal" :key="colOption.id">
            {{ votes(colOption, rowOption) }}
        </td>
    </tr>
</template>

<script>
import ListResultOption from './ListResultOption'

export default {
    components: { ListResultOption },
    props: {
        row: {
            type: Object,
            required: true,
        },
        columns: {
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
            return this.columns.map((option) => ({
                ...option,
                votes: this.votes(option),
            }))
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
