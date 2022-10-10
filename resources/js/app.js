// import "./bootstrap";
import App from "./app/Test.vue";

import { createApp } from "vue";
import pinia from "./app/store";

const app = createApp(App);
app.use(pinia);
app.mount("#app");
