import Vue from 'vue'
import TokenInput from './voter/TokenInput'

new Vue({
    el: '#app',
    components: {
        PropositionOptionEditor: () => import('./admin/PropositionOptionEditor'),
        TokenInput,
        VoterManagementPage: () => import('./admin/VoterManagementPage'),
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]')?.content,
        }
    },
})
