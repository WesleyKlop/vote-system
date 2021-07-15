<template>
    <div
        class='
            w-3/4
            relative
            h-8
            rounded
            border-2 border-gray-300
            overflow-hidden
            my-2
        '
        :class="{ 'font-bold': isWinning }"
    >
        <div
            v-if='showBar'
            class='mr-auto bg-gray-200 absolute left-0 inset-y-0'
            :style='{ width: `${percentage}%` }'
        ></div>
        <div class='z-10 leading-5 absolute px-2 py-1 left-0 inset-y-0'>
            {{ title }}: {{ count }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        option: {
            type: String,
            required: true,
        },
        count: {
            type: Number,
            required: true,
        },
        total: {
            type: Number,
            required: true,
        },
        isWinning: {
            type: Boolean,
            required: false,
            default: false,
        },
        showBar: {
            type: Boolean,
            required: true,
        }
    },
    computed: {
        title() {
            if (['abstain', 'blank'].includes(this.option)) {
                return this.$t(this.option)
            }
            return this.option
        },
        percentage() {
            if (this.count === 0) {
                return 0
            }

            return this.count / this.total * 100
        },
    },
}
</script>
