import axios from "axios";
import { defineStore } from "pinia";
import { API_LOCATION } from "../constants";

import { useStore as useUserStore } from "./user.store";
import { useStore as useAlertStore } from "./alert.store";

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

        async addItemInBasket($itemId) {
            this.loading = true;
            const alertStore = useAlertStore();

            const userStore = useUserStore();

            try {
                const response = await axios.post(
                    `${API_LOCATION}/shopcarts/addItem`,
                    {
                        id: userStore.user.id,
                        item_id: $itemId,
                    }
                );

                const { message } = response.data;
                alertStore.alert({ type: "success", message: message });
            } catch (error) {
                this.error = error;
                alertStore.alert({ type: "error", message: error });
            } finally {
                this.loading = false;
            }
        },

        async removeItemFromBasket($itemId) {
            this.loading = true;
            const alertStore = useAlertStore();

            const userStore = useUserStore();

            try {
                const response = await axios.post(
                    `${API_LOCATION}/shopcarts/removeItem`,
                    {
                        id: userStore.user.id,
                        item_id: $itemId,
                    }
                );

                const { message } = response.data;
                alertStore.alert({ type: "success", message: message });
            } catch (error) {
                this.error = error;
                alertStore.alert({ type: "error", message: error });
            } finally {
                this.loading = false;
            }
        },

        async emptyBasket() {
            this.loading = true;
            const alertStore = useAlertStore();

            const userStore = useUserStore();

            try {
                const response = await axios.post(
                    `${API_LOCATION}/shopcarts/emptyShopCart`,
                    {
                        id: userStore.user.id,
                    }
                );

                const { message } = response.data;
                alertStore.alert({ type: "success", message: message });
            } catch (error) {
                this.error = error;
                alertStore.alert({ type: "error", message: error });
            } finally {
                this.loading = false;
            }
        }
    },
});
