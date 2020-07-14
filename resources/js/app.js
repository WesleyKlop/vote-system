import Vue from 'vue'
import PropositionOptionEditor from './admin/PropositionOptionEditor'
import TokenInput from './voter/TokenInput'

new Vue({
    el: '#app',
    components: {
        PropositionOptionEditor,
        TokenInput,
        VoterManagementPage: () => import('./admin/VoterManagementPage'),
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]')?.content,
        }
    },
})
