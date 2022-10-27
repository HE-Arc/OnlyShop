import axios from "axios";
import { defineStore } from "pinia";
import { API_LOCATION } from "../constants";

const storeName = "userStore";
const defautSate = {
    loading: false,
    error: null,
};

export const useStore = defineStore(storeName, {
    state: () => defautSate,
    getters: {},
    actions: {
        async login(email, password) {
            this.loading = true;

            try {
                const response = await axios.post(
                    `${API_LOCATION}/users/login`,
                    {
                        email,
                        password,
                    }
                );

                const { message } = response.data;
                console.log(message);
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },

        async addUser(lastname, firstname, email, password, confirm_password) {
            this.loading = true;

            try {
                const response = await axios.post(`${API_LOCATION}/users`, {
                    lastname,
                    firstname,
                    email,
                    password,
                    confirm_password,
                });

                const { message } = response.data;
                console.log(message);
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
    },
});
