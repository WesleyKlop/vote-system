<template>
    <div class="grid grid-cols-2 gap-4 w-full sm:w-3/4 pt-4">
        <div class="col-span-1">
            <h3 class="sub-title">Horizontal options</h3>
            <ol class="list-outside list-decimal pl-4">
                <li :key="col.id" class="mb-1" v-for="col of horizontal">
                    <input
                        :name="`options[horizontal][${col.id || ''}]`"
                        @change="$emit('check-remove', col)"
                        @keyup="col.isDirty = true"
                        class="input w-full"
                        type="text"
                        v-model="col.option"
                    />
                </li>
            </ol>
        </div>
        <div class="col-span-1">
            <h3 class="sub-title">Vertical options</h3>
            <ol class="list-outside list-decimal pl-4">
                <li :key="row.id" class="mb-1" v-for="row of vertical">
                    <input
                        :name="`options[vertical][${row.id || ''}]`"
                        @change="$emit('check-remove', row)"
                        @keyup="row.isDirty = true"
                        class="input w-full"
                        type="text"
                        v-model="row.option"
                    />
                </li>
            </ol>
        </div>
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
        horizontal() {
            return this.getOptions('horizontal')
        },
        vertical() {
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

<style scoped></style>
