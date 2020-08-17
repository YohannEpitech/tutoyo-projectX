import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        UserData: {},
        token: '',
    },
    mutations: {
        initData(state) {
            if (localStorage.getItem("state")) {
                let tmp = JSON.parse(localStorage.getItem("state"))
                state.UserData = tmp.UserData
                state.token = tmp.token
            }
        },
    },
    actions: {},
    modules: {}
})