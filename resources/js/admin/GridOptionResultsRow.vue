<template>
    <tr>
        <th>{{ row.option }}</th>
        <td v-for="col of columns" :key="col.id">
            {{ votes(col) }}
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
        blankId: { type: String, required: false, default: null },
        abstainId: { type: String, required: false, default: null },
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
            if (!this.results[this.row.id]) {
                return 0
            }
            return Object.values(this.results[this.row.id]).reduce(
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
            return this.results[option.id]?.[this.row.id] ?? 0
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
