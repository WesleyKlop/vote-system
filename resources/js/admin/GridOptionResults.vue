<template>
    <div class="card-content">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th v-for="option of horizontal" :key="option.id">
                            {{ option.option }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="rowOption of vertical" :key="rowOption.id">
                        <th>{{ rowOption.option }}</th>
                        <td v-for="colOption of horizontal" :key="colOption.id">
                            {{ votes(colOption, rowOption) }}
                        </td>
                    </tr>
                </tbody>
            </table>
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
        results: {
            type: Object,
            required: true,
        },
    },
    computed: {
        vertical() {
            return this.options.filter((o) => o.axis === 'vertical')
        },
        horizontal() {
            return this.options.filter((o) => o.axis === 'horizontal')
        },
        totalVotes() {
            return 1
        },
    },
    methods: {
        votes(hor, ver) {
            return this.results[hor.id]?.[ver.id] ?? 0
        },
    },
}
</script>
