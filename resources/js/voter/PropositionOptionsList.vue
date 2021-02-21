<template>
    <div>
        <h3 class="sub-title">{{ question.option }}</h3>
        <button
            v-for="answer of answers"
            :key="answer.id"
            @click="selectAnswer(answer.id)"
            class="question-input-label"
            :class="{
                'question-input-label--selected':
                    question.selected === answer.id,
            }"
            :for="answer.id"
        >
            <span class="question-input-text">{{ answer.option }}</span>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        options: {
            type: Array,
            required: true,
        },
    },
    computed: {
        question() {
            return this.options.find((opt) => opt.axis === 'horizontal')
        },
        answers() {
            return this.options.filter((opt) => opt.axis === 'vertical')
        },
    },
    methods: {
        selectAnswer(verticalId) {
            return this.$emit('select', {
                horizontalId: this.question.id,
                verticalId,
            })
        },
    },
}
</script>

