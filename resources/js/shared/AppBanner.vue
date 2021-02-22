<template>
    <div class="banner" :class="bannerTypeClass"><slot /></div>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            required: true,
        },
    },
    computed: {
        bannerTypeClass() {
            return {
                failure: 'banner--failure',
                warning: 'banner--warning',
                success: 'banner--success',
            }[this.type]
        },
    },
}
</script>
