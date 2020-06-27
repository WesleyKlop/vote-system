<template>
    <div class="flex flex-col">
        <masked-input
            autocomplete="off"
            class="input input--token"
            mask="#### #### #### ####"
            maxlength="16"
            name="token"
            placeholder="ABCD 2345 WXYZ 6789"
            size="16"
            type="text"
            required
        />
        <div v-for="error of errors" class="font-normal text-failure">
            {{ error }}
        </div>
    </div>
</template>

<script>
import MaskedInput from 'vue-masked-input'

export default {
    components: {
        MaskedInput,
    },
    props: {
        value: {
            type: String,
            required: false,
            default: '',
        },
        errors: {
            type: Array,
            required: false,
            default: () => [],
        },
    },
    data() {
        return {
            currentValue: this.value,
        }
    },
}
</script>
