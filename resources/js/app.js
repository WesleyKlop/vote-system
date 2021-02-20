import Vue from 'vue'
import VueI18n from 'vue-i18n'
import { getAppLocale } from './helpers'
import TokenInput from './voter/TokenInput'

Vue.use(VueI18n)

const locale = getAppLocale()
// Create VueI18n instance with options
const i18n = new VueI18n({
    locale,
})

import(`../lang/${locale}.json`).then(messages => {
    i18n.setLocaleMessage(locale, messages)
})

new Vue({
    i18n,
    el: '#app',
    components: {
        PropositionOptionEditor: () =>
            import('./admin/PropositionOptionEditor'),
        TokenInput,
        VoterManagementPage: () => import('./admin/VoterManagementPage'),
    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]')?.content,
        }
    },
})
