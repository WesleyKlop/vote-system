<script>
export default {
    props: {
        sourceOptions: {
            type: Array,
            default: () => [],
            required: false,
        },
        errors: {
            // Json Encode converts empty dicts to arrays
            type: [Object, Array],
            default: () => ({}),
            required: false,
        },
    },
    data() {
        return {
            source: this.sourceOptions.map((item, i) => {
                item.isDirty = false
                item.id = item.id || i + 1
                return item
            }),
        }
    },
    created() {
        this.source = this.source.concat(
            this.createOption('horizontal'),
            this.createOption('vertical'),
        )
    },
    computed: {
        type() {
            const filledHorizontalOptions = this.options('horizontal').filter(
                (e) => e.option,
            )

            return filledHorizontalOptions.length > 1 ? 'Grid' : 'List'
        },
        horizontal() {
            return this.options('horizontal')
        },
        vertical() {
            return this.options('vertical')
        },
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
        options(axis) {
            const options = this.source.filter((e) => e.axis === axis)
            if (options.every((item) => item.option.length > 0)) {
                this.source.push(this.createOption(axis))
            }
            return options
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
    },
}
</script>

<template>
    <div class="grid grid-cols-2 gap-4 w-full sm:w-3/4">
        <div class="col-span-2">
            Proposition type: <span class="font-bold">{{ type }}</span>
        </div>
        <div class="text-failure text-sm col-span-2">
            <div v-for="error of allErrors">{{ error }}</div>
        </div>
        <div class="col-span-1">
            <h2 class="sub-title">Horizontal options</h2>
            <ol class="list-outside list-decimal pl-4">
                <li :key="col.id" class="mb-1" v-for="col of horizontal">
                    <input
                        type="text"
                        v-model="col.option"
                        @keyup="col.isDirty = true"
                        @change="removeIfRemovable(col)"
                        :name="`options[horizontal][${col.id || ''}]`"
                        class="input w-full"
                    />
                </li>
            </ol>
        </div>
        <div class="col-span-1">
            <h2 class="sub-title">Vertical options</h2>
            <ol class="list-outside list-decimal pl-4">
                <li :key="row.id" class="mb-1" v-for="row of vertical">
                    <input
                        type="text"
                        v-model="row.option"
                        @keyup="row.isDirty = true"
                        @change="removeIfRemovable(row)"
                        :name="`options[vertical][${row.id || ''}]`"
                        class="input w-full"
                    />
                </li>
            </ol>
        </div>
    </div>
</template>
