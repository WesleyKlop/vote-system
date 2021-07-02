<template>
    <div class="card-content">
        <h3 class="sub-title">{{ question.option }}</h3>
        <div class="w-3/4 relative h-8 rounded border-2 border-gray-300 overflow-hidden my-2" v-for='option of choices'>
            <div class="mr-auto bg-gray-200 absolute left-0 inset-y-0"
                 :style='{ width: `${percentage(option)}%` }'
                 ></div>
            <div class="z-10 leading-5 absolute px-2 py-1 left-0 inset-y-0">{{ option.option }}
                : {{ votes(option) }} ({{ percentage(option) }}%)
            </div>
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
        }
    },
    computed: {
        choices() {
            return this.options.filter(o => o.axis === 'vertical')
        },
        question() {
            return this.options.find(o => o.axis === 'horizontal')
        },
        totalVotes() {
            if(!this.results[this.question.id])  {
                return 0
            }
            return Object.values(this.results[this.question.id]).reduce((total, curr) => total + curr, 0)
        }
    },
    methods: {
        votes(option) {
            return this.results[this.question.id]?.[option.id] ?? 0;
        },
        percentage(option) {
            const votes = Math.max(this.votes(option), 1)
            return Math.round(((votes / this.totalVotes * 100) + Number.EPSILON) * 100) / 100;
        }
    }
}
</script>
