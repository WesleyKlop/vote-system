<template>
    <div>
        <div v-if='proposition' class='my-2 p-2 w-full lg:w-3/4'>
            <span class='text-gray-600'>
                {{ $t('Proposition') }} {{ proposition.order }}
            </span>
            <h2 class='title mb-6'>{{ proposition.title }}</h2>
            <live-proposition-results
                :type='proposition.type'
                :options='proposition.options'
                :results='results[proposition.id]'
            />
        </div>

        <live-control-actions
            :selected-open='proposition.is_open'
            :has-previous='propositionIdx > 0'
            :has-next='propositions[propositionIdx + 1] !== undefined'
            @next='toProposition(1)'
            @prev='toProposition(-1)'
            @toggle='toggleProposition(propositionIdx, $event)'
        />
    </div>
</template>

<script>
import echo from '../shared/websockets'
import LiveControlActions from './LiveControlActions'
import LivePropositionResults from './LivePropositionResults'
import PropositionService from './PropositionService'

export default {
    components: {
        LiveControlActions,
        LivePropositionResults,
    },
    props: {
        initialPropositionId: {
            type: String,
            required: false,
            default: null,
        },
        initialPropositions: {
            type: Array,
            required: true,
        },
        routes: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            propositionId: this.initialPropositionId,
            propositions: this.initialPropositions,
            propositionService: new PropositionService(
                this.$root.token,
                this.routes,
            ),
            results: {},
            resultTimestamp: null,
        }
    },
    mounted() {
        echo()
            .private('controls')
            .listen('PropositionChange', this.handlePropositionChange)
        echo().private('results').listen('VoterVoted', this.handleResultsChange)
        this.refreshPropositionResults()
    },
    beforeDestroy() {
        echo()
            .private('controls')
            .stopListening('PropositionChange', this.handlePropositionChange)
        echo()
            .private('results')
            .stopListening('VoterVoted', this.handleResultsChange)
    },
    computed: {
        propositionIdx() {
            return this.propositions.findIndex(
                (p) => p.id === this.propositionId,
            )
        },
        proposition() {
            return this.propositions[this.propositionIdx]
        },
    },
    methods: {
        handlePropositionChange({ proposition }) {
            const idx = this.propositions.findIndex(
                (p) => p.id === proposition.id,
            )

            console.log(proposition, idx)
            if (idx === -1) {
                this.propositions.push(proposition)
            } else {
                this.$set(this.propositions, idx, proposition)
            }
        },
        handleResultsChange({ results }) {
            results.forEach((result) =>
                this.addVote(
                    result.proposition_id,
                    result.horizontal_option_id,
                    result.vertical_option_id,
                ),
            )
        },
        addVote(p, h, v) {
            this.$set(this.results, p, this.results[p] ?? {})
            this.$set(this.results[p], h, this.results[p][h] ?? {})
            this.$set(this.results[p][h], v, (this.results[p][h][v] ?? 0) + 1)
        },
        toProposition(delta) {
            const nextPropositionIdx = this.propositionIdx + delta
            const nextProposition = this.propositions[nextPropositionIdx]

            this.propositionId = nextProposition.id
        },
        async toggleProposition(propositionIdx, newState) {
            // Optimistic update
            this.propositions[propositionIdx].is_open = newState

            this.propositions[propositionIdx] =
                await this.propositionService.toggleProposition(
                    this.propositions[propositionIdx].id,
                    newState,
                )
        },
        async refreshPropositionResults() {
            const results = await this.propositionService.fetchResults(
                this.propositionId,
            )
            this.results = results.data
            this.resultTimestamp = results.timestamp
        },
    },
}
</script>
