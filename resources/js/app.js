import Vue from 'vue'
import VueI18n from 'vue-i18n'
import { getAppLocale } from './shared/helpers'

Vue.use(VueI18n)

const locale = getAppLocale()
const i18n = new VueI18n({ locale })

import(`../lang/${locale}.json`).then((messages) => {
    i18n.setLocaleMessage(locale, messages)
})

new Vue({
    i18n,
    el: '#app',
    components: {
        LiveApplicationControls: () => import('./admin/LiveApplicationControls'),
        PropositionOptionEditor: () => import('./admin/PropositionOptionEditor'),
        VoterManagementPage: () => import('./admin/VoterManagementPage'),

        TokenInput: () => import('./voter/TokenInput'),
        VoterVotingPage: () => import('./voter/VoterVotingPage'),

        IllVote: () => import('./shared/IllVote'),
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]')?.content,
            token: document.querySelector('meta[name="voter-token"]')?.content,
        }
    },
})
