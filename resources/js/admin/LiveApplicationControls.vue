<template>
    <div>
        <div v-if='proposition' class='my-2 p-2 w-full lg:w-3/4'>
            <span class='text-gray-600'
            >{{ $t('Proposition') }} {{ proposition.order }}</span
            >
            <h2 class='title mb-6'>{{ proposition.title }}</h2>
        </div>

        <live-control-actions
            :selected-open='proposition.is_open'
            :has-previous='propositionIdx > 0'
            :has-next='propositions[propositionIdx+1] !== undefined'
            @next='toProposition(1)'
            @prev='toProposition(-1)'
            @toggle='handleToggleProposition'
        />
    </div>
</template>

<script>
import echo from '../shared/websockets'
import LiveControlActions from './LiveControlActions'
import PropositionService from './PropositionService'

export default {
    components: {
        LiveControlActions,
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
        }
    },
    mounted() {
        echo()
            .private('controls')
            .listen('PropositionChange', this.handlePropositionChange)
        echo()
            .private('results')
            .listen('ResultsChange', this.handleResultsChange)
    },
    beforeDestroy() {
        echo()
            .private('controls')
            .stopListening('PropositionChange', this.handlePropositionChange)
        echo()
            .private('results')
            .stopListening('ResultsChange', this.handleResultsChange)
    },
    computed: {
        propositionIdx() {
            return this.propositions.findIndex(p => p.id === this.propositionId)
        },
        proposition() {
            return this.propositions[this.propositionIdx]
        },
    },
    methods: {
        handlePropositionChange() {
            //
        },
        handleResultsChange() {
            //
        },
        toProposition(delta) {
            const nextProposition = this.propositions[this.propositionIdx + delta]

            if (delta > 0) {
                // If moving forward, open it now!
                nextProposition.is_open = true
            }

            // Always close the current proposition
            this.proposition.is_open = false
            this.propositionId = nextProposition.id
        },
        handleToggleProposition(newState) {
            this.proposition.is_open = newState
        },
    },
}
</script>
