import "./bootstrap";
import "vuetify/styles"; //Global CSS
import { createApp } from "vue";
import { createVuetify } from 'vuetify';
import Login from "./app/Login.vue";

import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import 'material-design-icons-iconfont/dist/material-design-icons.css'

const login = createApp(Login);
const vuetify = createVuetify({
    components,
    directives,
});

login.use(vuetify);
login.mount("#login");
