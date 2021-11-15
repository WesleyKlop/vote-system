<template>
    <button
        class="question-input-label"
        @click="$emit('select')"
        :class="{ 'question-input-label--selected': isSelected }"
    >
        <span class="question-input-text">{{ title }}</span>
    </button>
</template>

<script>
export default {
    props: {
        option: {
            type: String,
            required: true,
        },
        isSelected: {
            type: Boolean,
            required: false,
            default: false,
        },
    },
    computed: {
        title() {
            if (['abstain', 'blank'].includes(this.option)) {
                return this.$t(this.option)
            }
            return this.option
        },
    },
}
</script>
