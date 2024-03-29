<script>
import GridOptionEditor from './GridOptionEditor'
import ListOptionEditor from './ListOptionEditor'

export default {
    components: {
        GridOptionEditor,
        ListOptionEditor,
    },
    props: {
        sourceOptions: {
            type: Array,
            default: () => [],
            required: false,
        },
        initialType: {
            type: String,
            required: false,
            default: 'grid',
        },
        errors: {
            type: [Object, Array],
            default: () => ({}),
            required: false,
        },
    },
    data() {
        return {
            type: this.initialType,
            source: this.sourceOptions.map((item, i) => ({
                ...item,
                isDirty: false,
                id: item.id || i + 1,
            })),
        }
    },
    created() {
        const extraOptions = [this.createOption('vertical')]
        if (this.initialType === 'grid' || this.source.length === 0) {
            extraOptions.push(this.createOption('horizontal'))
        }
        this.source = this.source.concat(extraOptions)
    },
    computed: {
        allErrors() {
            return Object.values(this.errors).flat()
        },
    },
    methods: {
        createOption(axis) {
            const lastOptionId =
                this.source.length > 0
                    ? this.source[this.source.length - 1].id + 1
                    : 0

            return {
                axis: axis,
                option: '',
                isDirty: false,
                id: lastOptionId,
            }
        },
        isRemovable({ option, isDirty }) {
            return isDirty === true && option === ''
        },
        removeIfRemovable(option) {
            if (this.isRemovable(option)) {
                const indexToRemove = this.source.findIndex(
                    (item) => item.id === option.id,
                )
                this.source.splice(indexToRemove, 1)
            }
        },
        handleCreateOption(axis) {
            this.source = [...this.source, this.createOption(axis)]
        },
    },
}
</script>

<template>
    <div class="w-full mt-6">
        <h2 class="sub-title">{{ $t('Options') }}</h2>
        <input
            class="radio-input"
            hidden
            id="type-list"
            name="type"
            type="radio"
            v-model="type"
            value="list"
        />
        <label class="radio-input-label" for="type-list">
            <span class="radio-input-text">{{ $t('List') }}</span>
        </label>
        <input
            class="radio-input"
            hidden
            id="type-grid"
            name="type"
            type="radio"
            v-model="type"
            value="grid"
        />
        <label class="radio-input-label" for="type-grid">
            <span class="radio-input-text">{{ $t('Grid') }}</span>
        </label>
        <div class="text-failure text-sm">
            <div v-for="error of allErrors">{{ error }}</div>
        </div>
        <component
            :is="`${type}-option-editor`"
            :options="source"
            @check-remove="removeIfRemovable"
            @create:option="handleCreateOption"
        />
    </div>
</template>
