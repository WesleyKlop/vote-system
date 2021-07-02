<template>
    <div class="flex mx-auto">
        <button class="button" v-if="hasPrevious" @click="$emit('prev')">
            {{ $t('Previous') }}
        </button>
        <button class="button" @click="$emit('toggle', !selectedOpen)">
            {{ $t('Change to') }} {{ newState }}
        </button>
        <button class="button" v-if="hasNext" @click="$emit('next')">
            {{ $t('Next') }}
        </button>
    </div>
</template>

<script>
export default {
    props: {
        selectedOpen: {
            type: Boolean,
            required: true,
        },
        hasNext: {
            type: Boolean,
            required: true,
        },
        hasPrevious: {
            type: Boolean,
            required: true,
        },
    },
    computed: {
        newState() {
            return this.selectedOpen ? this.$t('Closed') : this.$t('Open')
        },
    },
}
</script>
