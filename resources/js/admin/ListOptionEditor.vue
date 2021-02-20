<template>
    <div class="w-full sm:w-3/4">
        <label class="input-label">
            {{ $t('Question') }}
            <input
                :name="`options[horizontal][${question.id || ''}]`"
                @change="$emit('check-remove', question)"
                @keyup="question.isDirty = true"
                autocomplete="off"
                class="input"
                :placeholder="$t('How do you like this?')"
                required
                type="text"
                v-model="question.option"
            />
        </label>
        <label class="input-label mb-0" id="choice-label">{{ $t('Choices') }}</label>
        <ol class="list-outside list-decimal pl-4">
            <li :key="row.id" class="mb-1" v-for="row of choices">
                <input
                    :name="`options[vertical][${row.id || ''}]`"
                    @change="$emit('check-remove', row)"
                    @keyup="row.isDirty = true"
                    aria-labelledby="choice-label"
                    class="input w-full"
                    type="text"
                    v-model="row.option"
                />
            </li>
        </ol>
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
            return this.options.find((option) => option.axis === 'horizontal')
        },
        choices() {
            return this.getOptions('vertical')
        },
    },
    methods: {
        getOptions(axis) {
            const options = this.options.filter((e) => e.axis === axis)
            if (options.every((item) => item.option.length > 0)) {
                this.$emit('create:option', axis)
            }
            return options
        },
    },
}
</script>
