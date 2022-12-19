import axios from "axios";
import { defineStore } from "pinia";
import { API_LOCATION } from "../constants";

const storeName = "imageStore";
const defautSate = {
    loading: false,
    error: null,
};

export const useStore = defineStore(storeName, {
    state: () => defautSate,
    getters: {},
    actions: {
        async getAllImages(item_id) {
            this.loading = true;

            try {
                const response = await axios.get(
                    `${API_LOCATION}/images/getItemImages/${item_id}`
                );

                const { data } = response.data;

                return data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
    },
});
