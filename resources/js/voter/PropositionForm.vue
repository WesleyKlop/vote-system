<template>
    <div class="my-2 p-2 w-full lg:w-3/4">
        <input type="hidden" name="_token" :value="$root.csrf" />

        <span class="text-gray-600">
            {{ $t('Proposition') }} {{ proposition.order }}
        </span>
        <h2 class="title mb-6">{{ proposition.title }}</h2>

        <component
            :is="`proposition-options-${proposition.type}`"
            :options="proposition.options"
            @select="$emit('option:select', $event)"
        />

        <button type="button" class="submit-button" @click="$emit('submit')">
            {{ $t('Vote') }}
        </button>
    </div>
</template>

<script>
import PropositionOptionsGrid from './PropositionOptionsGrid'
import PropositionOptionsList from './PropositionOptionsList'

export default {
    components: {
        PropositionOptionsList,
        PropositionOptionsGrid,
    },
    props: {
        proposition: {
            type: Object,
            required: false,
            default: () => null,
        },
    },
}
</script>

<style scoped></style>
