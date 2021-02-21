<template>
    <div
        v-if='!proposition || proposition.is_open === false'
        class='text-center px-4 sm:px-0'
    >
        {{ $t('There is currently no proposition for you to answer') }}
    </div>
    <proposition-form
        v-else
        :proposition='proposition'
        @submit='submitAnswers'
        @option:select='selectOption'
    />
</template>

<script>
import echo from '../shared/websockets'
import PropositionForm from './PropositionForm'

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
            channel: null,
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
            const payload = {
                proposition: this.proposition.id,
                answers: this.proposition.options.reduce((answers, curr) => {
                    if ('selected' in curr) {
                        answers[curr.id] = curr.selected
                    }
                    return answers
                }, {}),
            }
            console.log(payload)
            console.log(echo()
                .private('propositions'))
        },
    },
}
</script>
