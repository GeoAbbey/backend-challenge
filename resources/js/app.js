/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'Vuex';

Vue.use(Vuex);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.mixin({
    data () {
        return {
            carts : [],
            encrypted: false,
            encryptsecret: 'dogpound_by_ridwan_123456789.',
            decryptsecret: 'dogpound_by_ridwan_123456789.'
        }
    },
    methods: {
        getAttendee : function () {
            return window.localStorage.getItem('attendee') != null ? JSON.parse(window.localStorage.getItem('attendee')) : []
        },
        getAttendeeToken : function() {
            return window.localStorage.getItem('attendeeToken') != null ? JSON.parse(window.localStorage.getItem('attendeeToken')) : ''
        },
        clearLocalStorage : function () {
            return window.localStorage.getItem('carts') != null ? window.localStorage.clear() : []
        },
        removeItemFromStorage : function (key) {
            return window.localStorage.getItem(key) != null ? window.localStorage.removeItem(key) : ''
        },
        isAttendeeLoggedIn : function() {
            return !!this.getAttendeeToken()
        },
        handleError (error) {
            if (error.response.data) {
                if (typeof error.response.data === 'string') {
                    return alert(error.response.data);
                }
                if (error.response.status === 422) {
                    let errors = [];
                    console.log(error.response.data.errors)
                    for (var key in error.response.data.errors) {
                        error.response.data.errors[key].forEach(element => {
                            errors.push(`${key}: ${element}`);
                        });
                    }
                    return alert(errors.join("\n"));
                }
                if (error.response.status === 418 && error.response.data.message) {
                    return alert(error.response.data);
                }
            }
            return alert('We could not handle your request');
        }
    }
})


const app = new Vue({
    el: '#app'
});
