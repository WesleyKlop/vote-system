<template>
    <div class="px-8 sm:px-0">
        <h1 class="title">{{ $t('Voter management') }}</h1>
        <p class="mt-2 text-gray-600">
            {{ $t('On this page you can manage the tokens usable by voters') }}
        </p>
        <p v-html="$t('Token refresh warning')" />
        <div class="flex flex-col sm:flex-row justify-between">
            <form
                :action="updateRoute"
                class="my-4 flex flex-wrap items-end w-64"
                method="POST"
            >
                <input :value="csrf" name="_token" type="hidden" />
                <label class="input-label inline-flex my-0 flex-1" for="amount">
                    {{ $t('Amount of tokens') }}
                    <input
                        class="input rounded-r-none"
                        id="amount"
                        maxlength="3"
                        minlength="1"
                        name="amount"
                        placeholder="12"
                        required
                        size="3"
                        type="tel"
                    />
                </label>
                <input
                    class="submit-button py-1 align-bottom my-0 -ml-1 rounded-l-none"
                    type="submit"
                    value="Generate"
                />
                <span
                    class="text-failure text-sm font-normal w-full"
                    v-if="'amount' in errors"
                    >{{ errors.amount }}</span
                >
            </form>

            <button @click="handlePrintTokenClick" class="button" type="button">
                {{ $t('Print tokens') }}
            </button>
        </div>

        <hr />

        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 py-6"
        >
            <token-card
                :delete-route="deleteRouteFor(voter.id)"
                :key="voter.id"
                :number="i + 1"
                :token="voter.token"
                :used-at="voter.used_at && new Date(voter.used_at)"
                v-for="(voter, i) of voters"
            />
        </div>
    </div>
</template>

<script>
import TokenCard from './TokenCard'
import { printTokens } from './TokenPrintService'

export default {
    components: {
        TokenCard,
    },
    props: {
        voters: {
            type: Array,
            required: true,
        },
        deleteRoute: {
            type: String,
            required: true,
        },
        updateRoute: {
            type: String,
            required: true,
        },
        errors: {
            type: Object,
            required: false,
            default: () => ({}),
        },
    },
    methods: {
        deleteRouteFor(voterId) {
            return this.deleteRoute.replace(':id', voterId)
        },
        handlePrintTokenClick() {
            const tokens = this.voters.map((voter) => voter.token)
            printTokens(tokens)
        },
    },
    computed: {
        csrf() {
            return this.$root.csrf
        },
    },
}
</script>
