import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');
let token = document.head.querySelector('meta[name="csrf-token"]');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': token.content
    }
});

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    namespace: 'App.Events',
    broadcaster: 'pusher',
    key: 'f159bf8e622a9a565b4f',
    cluster: 'ap1',
    encrypted: true
});


