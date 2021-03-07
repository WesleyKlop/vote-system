<template>
    <div class="my-2 p-2 w-full lg:w-3/4">
        <span class="text-gray-600">
            {{ $t('Proposition') }} {{ proposition.order }}
        </span>
        <h2 class="title mb-6">{{ proposition.title }}</h2>

        <app-banner
            v-if="!errors.length && isAnswered"
            type="neutral"
            class="mb-4"
            >{{ $t('You already answered this proposition') }}</app-banner
        >

        <component
            :is="`proposition-options-${proposition.type}`"
            :options="proposition.options"
            @select="$emit('option:select', $event)"
        />

        <app-banner
            :key="error"
            v-for="error of errors"
            :type="isAnswered ? 'success' : 'failure'"
            class="rounded-lg"
            >{{ error }}</app-banner
        >

        <button
            type="button"
            class="submit-button"
            @click="$emit('submit')"
            v-if="!isAnswered"
        >
            {{ $t('Vote') }}
        </button>
    </div>
</template>

<script>
import AppBanner from '../shared/AppBanner'
import PropositionOptionsGrid from './PropositionOptionsGrid'
import PropositionOptionsList from './PropositionOptionsList'

export default {
    components: {
        AppBanner,
        PropositionOptionsList,
        PropositionOptionsGrid,
    },
    props: {
        isAnswered: {
            type: Boolean,
            required: false,
        },
        proposition: {
            type: Object,
            required: false,
            default: () => null,
        },
        errors: {
            type: Array,
            required: false,
            default: () => [],
        },
    },
}
</script>
