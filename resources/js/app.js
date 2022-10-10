import "./bootstrap";
import "vuetify/styles"; //Global CSS
import { createApp } from "vue";
import { createVuetify } from "vuetify";
import App from "./app/App.vue";
import pinia from "./app/store";

import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import "material-design-icons-iconfont/dist/material-design-icons.css";

const vuetify = createVuetify({
    components,
    directives,
});

const app = createApp(App);
app.use(pinia);
app.use(vuetify);
app.mount("#app");
