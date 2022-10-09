// import "./bootstrap";
import App from "./app/App.vue";

import { createApp } from "vue";
import pinia from "./app/store";

createApp(App).use(pinia).mount("#app");
