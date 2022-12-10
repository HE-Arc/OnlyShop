import { defineStore } from "pinia";
import { v4 as uuid } from "uuid";

const storeName = "alertStore";
const defautSate = {
    alerts: [],
};

export const useStore = defineStore(storeName, {
    // persist: true,
    state: () => defautSate,
    getters: {},
    actions: {
        alert({ id = uuid().toString(), type, message }) {
            this.alerts.push({ id, type, message });
        },
        removeAlert(id) {
            this.alerts = this.alerts.filter((alert) => alert.id !== id);
        },
    },
});
