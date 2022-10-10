import "./bootstrap";
import "vuetify/styles"; //Global CSS
import { createApp } from "vue";
import { createVuetify } from 'vuetify';
import EditItem from "./app/EditItem.vue";

import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import 'material-design-icons-iconfont/dist/material-design-icons.css'

const edit = createApp(EditItem);
const vuetify = createVuetify({
    components,
    directives,
});

edit.use(vuetify);
edit.mount("#edit");
