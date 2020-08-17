import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import i18n from './locale'

import VueMarkdownEditor from '@kangc/v-md-editor';
import '@kangc/v-md-editor/lib/style/base-editor.css';
import vuepressTheme from '@kangc/v-md-editor/lib/theme/vuepress.js';
import enUS from '@kangc/v-md-editor/lib/lang/en-US';

import VMdPreview from '@kangc/v-md-editor/lib/preview';
import '@kangc/v-md-editor/lib/style/preview.css';
import githubTheme from '@kangc/v-md-editor/lib/theme/github.js';




VMdPreview.use(githubTheme);
Vue.use(require('vue-moment'));
Vue.use(VMdPreview);
VueMarkdownEditor.use(vuepressTheme);
VueMarkdownEditor.lang.use('en-US', enUS);
Vue.config.productionTip = false
Vue.use(VueMarkdownEditor);


new Vue({
    router,
    i18n,
    store,
    beforeCreate() {
        this.$store.commit('initData')
    },
    render: function(h) {
        return h(App)
    }
}).$mount('#app')