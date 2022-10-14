/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : set up the app with the router, pinia, vuetify, icons

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
*/

import "./bootstrap";
import "vuetify/styles"; //Global CSS
import { createApp } from "vue";
import { createVuetify } from "vuetify";
import "material-design-icons-iconfont/dist/material-design-icons.css";
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';
import App from "./app/App.vue";

import pinia from "./app/store";
import router from "./router";

import * as components from "vuetify/components";
import * as directives from "vuetify/directives";



const vuetify = createVuetify({
    components,
    directives,
});


const app = createApp(App);
app.use(router);
app.use(pinia);
app.use(vuetify);


app.mount("#app");
