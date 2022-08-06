import { createStore } from 'vuex';
import api from '../api';

export default createStore({
    state: {
        user: {
            loggedIn: false
        },
        flashMessage: '',
        formData: false,
        allReports: false,
    },
    getters: {
        auth(state) {
            return state.user;
        },
        flashMessage(state) {
            return state.flashMessage;
        },
        formData(state) {
            return state.formData;
        },
        getPackageIndex(state) {
            let index = state.formData.departureTypes.find(
                ({ type }) => type == "Посылка"
            );

            return index && Number.isInteger(index.id) ? index.id : -1;
        },
        allReports(state) {
            return state.allReports;
        }
    },
    mutations: {
        logged(state, payload) {
            state.user.loggedIn = payload;
        },
        flashMessage(state, payload) {
            state.flashMessage = payload;
        },
        formData(state, payload) {
            state.formData = payload;
        },
        allReports(state, payload) {
            state.allReports = payload;
        }
    },
    actions: {
        logged(context, payload) {
            context.commit('logged', payload);
        },
        flashMessage(context, payload) {
            context.commit('flashMessage', payload);
        },
        formData(context, payload) {
            context.commit('formData', payload);
        },
        allReports(context, payload) {
            context.commit('allReports', payload);
        }
    }
});