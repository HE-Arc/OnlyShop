import axios from "axios";
import { defineStore } from "pinia";
import { API_LOCATION } from "../constants";

const storeName = "shopcartStore";
const defautSate = {
    items: [],
    loading: false,
    error: null,
};

export const useStore = defineStore(storeName, {
    state: () => defautSate,
    getters: {},
    actions: {
        async fetchItems(id) {
            this.items = [];
            this.loading = true;

            try {
                const response = await axios.get(
                    `${API_LOCATION}/shopcarts/${id}`
                );

                const { data } = response.data;
                this.items = data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async addItem(id, item_id) {
            this.loading = true;

            try {
                const response = await axios.post(`${API_LOCATION}/shopcarts`, {
                    id,
                    item_id,
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
