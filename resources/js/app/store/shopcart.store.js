import axios from "axios";
import { defineStore } from "pinia";
import { API_LOCATION } from "../constants";

import { useStore as useUserStore } from "./user.store";
import { useStore as useAlertStore } from "./alert.store";
import { useStore as useItemStore } from "./item.store";

const storeName = "shopcartStore";
const defautSate = {
    items: [],
    loading: false,
    error: null,
    totalBascketPrice: 0,
};

export const useStore = defineStore(storeName, {
    state: () => defautSate,
    getters: {},
    actions: {
        async addItemInBasket(itemId) {
            this.loading = true;
            const alertStore = useAlertStore();

            const userStore = useUserStore();
            const itemStore = useItemStore();

            try {
                const response = await axios.post(
                    `${API_LOCATION}/shopcarts/addItem`,
                    {
                        id: userStore.user.id,
                        item_id: itemId,
                    }
                );

                const { message } = response.data;
                alertStore.alert({ type: "success", message: message });

                // add item to basket
                const item = itemStore.allItems.find(
                    (item) => item.id === itemId
                );
                this.items.push(item);
            } catch (error) {
                this.error = error;
                alertStore.alert({ type: "error", message: error });
            } finally {
                this.loading = false;
            }
        },

        async fetchBasketItems() {
            this.basketItems = [];
            this.loading = true;

            const userStore = useUserStore();
            const itemStore = useItemStore();

            try {
                const response = await axios.get(
                    `${API_LOCATION}/shopcarts/getAllItemsInShopCart/${userStore.user.id}`
                );

                console.log(response.data);

                const { data } = response.data;

                this.item = data;
                this.totalBascketPrice = response.data.message;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },

        async removeItemFromBasket(itemId) {
            this.loading = true;
            const alertStore = useAlertStore();

            const userStore = useUserStore();
            const itemStore = useItemStore();

            try {
                const response = await axios.post(
                    `${API_LOCATION}/shopcarts/removeItem`,
                    {
                        id: userStore.user.id,
                        item_id: itemId,
                    }
                );

                const { message } = response.data;
                alertStore.alert({ type: "success", message: message });

                // remove item from basket
                const itemToDelete = itemStore.allItems.find(
                    (item) => item.id === itemId
                );

                this.items = this.items.filter(
                    (item) => item.id !== itemToDelete.id
                );

                // update total price
                this.totalBascketPrice =
                    this.totalBascketPrice - itemToDelete.attributes.price;
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

                // update total price
                this.totalBascketPrice = 0;

                // empty basket
                this.items = [];
            } catch (error) {
                this.error = error;
                alertStore.alert({ type: "error", message: error });
            } finally {
                this.loading = false;
            }
        },
    },
});
