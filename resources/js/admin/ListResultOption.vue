<template>
    <div
        class="
            w-3/4
            relative
            h-8
            rounded
            border-2 border-gray-300
            overflow-hidden
            my-2
        "
    >
        <div
            class="mr-auto bg-gray-200 absolute left-0 inset-y-0"
            :style="{ width: `${percentage}%` }"
        ></div>
        <div class="z-10 leading-5 absolute px-2 py-1 left-0 inset-y-0">
            {{ option }} : {{ count }} ({{ percentage }}%)
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
    },
    computed: {
        percentage() {
            if (this.count === 0) {
                return 0
            }

            return (
                Math.round((this.count / this.total) * 10000 + Number.EPSILON) /
                100
            )
        },
    },
}
</script>
