import axios from "axios";
import { defineStore } from "pinia";
import { API_LOCATION } from "../constants";
import { useStore as useAlertStore } from "./alert.store";

const storeName = "userStore";
const defautSate = {
    loading: false,
    error: null,
    user: null,
};

export const useStore = defineStore(storeName, {
    persist: true,
    state: () => defautSate,
    getters: {},
    actions: {
        async login(user) {
            this.loading = true;
            const alertStore = useAlertStore();

            try {
                // Request to the API
                const response = await axios.post(
                    `${API_LOCATION}/login`,
                    user
                );

                // Retreive the data from the response
                const {
                    message,
                    data: { id, token },
                } = response.data;

                // Display the message
                alertStore.alert({ type: "success", message: message });

                // Alter the current state of the store
                this.user = { ...user, id, token };
                this.error = null;
            } catch (error) {
                alertStore.alert({ type: "error", message: error });
                this.error = error;
            } finally {
                this.loading = false;
            }
        },

        async logout() {
            this.loading = true;
            const alertStore = useAlertStore();

            try {
                // Request to the API
                const response = await axios.post(
                    `${API_LOCATION}/logout`,
                    this.user,
                    { headers: { Authorization: `Bearer ${this.user.token}` } }
                );

                // Retreive the data from the response
                const { message } = response.data;

                // Display the message
                alertStore.alert({ type: "success", message: message });

                // Alter the current state of the store
                this.user = null;
                this.error = null;
            } catch (error) {
                alertStore.alert({ type: "error", message: error });
                this.error = error;
            } finally {
                this.loading = false;
            }
        },

        async register(user) {
            this.loading = true;
            const alertStore = useAlertStore();

            try {
                // Request to the API
                const response = await axios.post(
                    `${API_LOCATION}/register`,
                    user
                );

                // Retreive the data from the response
                const { message } = response.data;

                // Display the message
                alertStore.alert({ type: "success", message: message });

                // Alter the current state of the store
                this.error = null;
            } catch (error) {
                alertStore.alert({ type: "error", message: error });
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
    },
});
