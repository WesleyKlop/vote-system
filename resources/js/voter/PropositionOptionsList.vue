<template>
    <div>
        <h3 class="sub-title">{{ question.option }}</h3>
        <list-option-item
            v-for="answer of answers"
            :key="answer.id"
            :option="answer.option"
            :is-selected="question.selected === answer.id"
            @select="selectAnswer(answer.id)"
        >
        </list-option-item>
    </div>
</template>

<script>
import ListOptionItem from './ListOptionItem'

export default {
    components: { ListOptionItem },
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
