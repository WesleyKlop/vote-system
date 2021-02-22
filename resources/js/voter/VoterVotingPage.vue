<template>
    <proposition-form
        v-if="proposition && proposition.is_open === true"
        :proposition="proposition"
        @submit="submitAnswers"
        @option:select="selectOption"
        :is-answered="answeredCurrentProposition"
        :errors="errors"
    />
    <div v-else class="text-center px-4 sm:px-0">
        <ill-team-work class="w-full p-8 max-w-screen-md mx-auto md:p-16" />
        <span class="text-gray-900">{{
            $t('There is currently no proposition for you to answer')
        }}</span>
    </div>
</template>

<script>
import AppError, { ValidationError } from '../shared/errors'
import echo from '../shared/websockets'
import PropositionForm from './PropositionForm'
import IllTeamWork from '../shared/IllTeamWork'
import VotingService from './VotingService'

export default {
    components: {
        IllTeamWork,
        PropositionForm,
    },
    props: {
        initialProposition: {
            type: Object,
            required: false,
            default: null,
        },
        answeredPropositionIds: {
            type: Array,
            required: false,
            default: () => [],
        },
        voteRoute: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            proposition: this.initialProposition,
            answeredPropositions: this.answeredPropositionIds,
            errors: [],
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
            if (
                proposition.id !== this.proposition?.id &&
                proposition.is_open === false
            ) {
                console.warn('Ignoring out of order proposition change')
                return
            }
            this.proposition = proposition
            this.errors = []
        },
        selectOption({ horizontalId, verticalId }) {
            const option = this.proposition.options.find(
                (option) => option.id === horizontalId,
            )
            this.$set(option, 'selected', verticalId)
        },
        async submitAnswers() {
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

            try {
                await votingService.submitAnswers(propositionId, answers)
                this.answeredPropositions.push(propositionId)
                this.errors = [this.$t('You have answered the proposition!')]
            } catch (error) {
                if (error instanceof ValidationError) {
                    this.errors = error.errors.answers
                } else if (error instanceof AppError) {
                    this.errors = [error.message]
                }
            }
        },
    },
    computed: {
        answeredCurrentProposition() {
            return this.answeredPropositions.includes(this.proposition?.id)
        },
    },
}
</script>
