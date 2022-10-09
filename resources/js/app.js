import "./bootstrap";
import "vuetify/styles"; //Global CSS
import { createApp } from "vue";
import { createVuetify } from 'vuetify';
import App from "./app/App.vue";

import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import 'material-design-icons-iconfont/dist/material-design-icons.css'

const app = createApp(App);
const vuetify = createVuetify({
    components,
    directives,
});

app.use(vuetify);
app.mount("#app");
