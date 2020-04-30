<script>
export default {
    props: {
        sourceOptions: {
            type: Array,
            default: () => [
                { vector: 'horizontal', option: 'Voorzitter' },
                { vector: 'horizontal', option: 'Vice-vo' },
                { vector: 'horizontal', option: 'Penny' },
                { vector: 'horizontal', option: 'Extern' },
                { vector: 'horizontal', option: 'Secretaris' },
                { vector: 'horizontal', option: 'Intern' },
                { vector: 'vertical', option: 'Wesley' },
                { vector: 'vertical', option: 'Sander' },
                { vector: 'vertical', option: 'Niels' },
                { vector: 'vertical', option: 'Peter' },
                { vector: 'vertical', option: 'Jason' },
            ],
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
        this.source.push([
            this.createOption('horizontal'),
            this.createOption('vertical'),
        ])
    },
    computed: {
        horizontal() {
            return this.options('horizontal')
        },
        vertical() {
            return this.options('vertical')
        },
    },
    methods: {
        createOption(axis) {
            const lastOptionId =
                this.source.length > 0
                    ? this.source[this.source.length - 1].id + 1
                    : 0

            this.source.push({
                vector: axis,
                option: '',
                isDirty: false,
                id: lastOptionId,
            })
        },
        options(axis) {
            const options = this.source.filter((e) => e.vector === axis)
            if (options.every((item) => item.option.length > 0)) {
                this.createOption(axis)
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
    <table>
        <thead>
            <tr>
                <th></th>
                <th :key="col.id" v-for="col of horizontal">
                    <input
                        type="text"
                        v-model="col.option"
                        @keyup="col.isDirty = true"
                        @change="removeIfRemovable(col)"
                        :name="`options[horizontal][${col.id || ''}]`"
                        class="border"
                    />
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="row of vertical" :key="row.id">
                <td>
                    <input
                        type="text"
                        v-model="row.option"
                        @keyup="row.isDirty = true"
                        @change="removeIfRemovable(row)"
                        :name="`options[vertical][${row.id || ''}]`"
                        class="border"
                    />
                </td>
                <td v-for="_ in horizontal.length + 1" :key="_"></td>
            </tr>
        </tbody>
    </table>
</template>
