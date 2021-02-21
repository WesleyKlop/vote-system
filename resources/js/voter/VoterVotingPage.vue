<template>
    <div
        v-if="!proposition || proposition.is_open === false"
        class="text-center px-4 sm:px-0"
    >
        {{ $t('There is currently no proposition for you to answer') }}
    </div>
    <proposition-form
        v-else
        :proposition="proposition"
        @submit="submitAnswers"
        @option:select="selectOption"
        :disabled="answeredCurrentProposition"
    />
</template>

<script>
import echo from '../shared/websockets'
import PropositionForm from './PropositionForm'
import VotingService from './VotingService'

export default {
    components: {
        PropositionForm,
    },
    props: {
        initialProposition: {
            type: Object,
            required: false,
            default: () => null,
        },
        voteRoute: { type: String, required: true },
    },
    data() {
        return {
            proposition: this.initialProposition,
            answeredPropositions: [],
        }
    },
    mounted() {
        echo()
            .private('propositions')
            .listen('PropositionChange', this.handlePropositionChange)
    },
    beforeDestroy() {
        echo()
            .private('propositions')
            .stopListening('PropositionChange', this.handlePropositionChange)
    },
    methods: {
        handlePropositionChange({ proposition }) {
            this.proposition = proposition
        },
        selectOption({ horizontalId, verticalId }) {
            const option = this.proposition.options.find(
                (option) => option.id === horizontalId,
            )
            this.$set(option, 'selected', verticalId)
        },
        submitAnswers() {
            const propositionId = this.proposition.id
            const answers = this.proposition.options.reduce((answers, curr) => {
                if ('selected' in curr) {
                    answers[curr.id] = curr.selected
                }
                return answers
            }, {})

            const votingService = new VotingService(
                this.$root.token,
                this.voteRoute,
            )
            votingService.submitAnswers(propositionId, answers).then(() => {
                this.answeredPropositions.push(propositionId)
            })
        },
    },
    computed: {
        answeredCurrentProposition() {
            return this.answeredPropositions.includes(this.proposition?.id)
        },
    },
}
</script>
