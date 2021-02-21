<template>
    <div class='table-wrapper mb-2'>
        <table class='table'>
            <thead>
            <tr>
                <th />
                <th v-for='column of columns' :key='column.id'>{{ column.option }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for='row of rows' :key='row.id'>
                <th>{{ row.option }}</th>
                <td v-for='column of columns' :key='column.id'>
                    <button
                        class='vote-radio-label'
                        :class="{ 'vote-radio-label--selected': row.selected === column.id }"
                        @click='selectAnswer(row.id, column.id)'
                    >
                        <span />
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
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
        columns() {
            return this.options.filter((opt) => opt.axis === 'horizontal')
        },
        rows() {
            return this.options.filter((opt) => opt.axis === 'vertical')
        },
    },
    methods: {
        selectAnswer(horizontalId, verticalId) {
            return this.$emit('select', { horizontalId, verticalId, })
        },
    },
}
</script>

