import axios from "axios";
import { defineStore } from "pinia";
import { API_LOCATION } from "../constants";
//import { v4 as uuidv4 } from "uuid";
import { useStore as useUserStore } from "./user.store";

const storeName = "itemStore";
const defautSate = {
    allItems: [],
    userItems: [],
    basketItems:[],
    currentEditItem: null,
    loading: false,
    error: null,
};

export const useStore = defineStore(storeName, {
    state: () => defautSate,
    getters: {},
    actions: {
        async setCurrentEditItem(id) {
            this.currentEditItem = null;
            this.loading = true;

            try {
                const response = await axios.get(`${API_LOCATION}/items/${id}`);

                const { data } = response.data;
                this.currentEditItem = data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async fetchAllItems() {
            this.allItems = [];
            this.loading = true;

            try {
                const response = await axios.get(`${API_LOCATION}/items`);

                const { data } = response.data;

                this.allItems = data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async fetchUserItems() {
            this.userItems = [];
            this.loading = true;
            const userStore = useUserStore();

            try {
                const response = await axios.get(
                    `${API_LOCATION}/items/getUserItems/${userStore.user.id}`
                );

                const { data } = response.data;
                this.userItems = data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async fetchBasketItems() {
            this.basketItems = [];
            this.loading = true;
            const userStore = useUserStore();

            try {
                const response = await axios.get(
                    `${API_LOCATION}/shopcarts/getAllItemsInShopCart/${userStore.user.id}`
                );

                console.log(response);

                const { data } = response.data;
                this.basketItems = data;
            }
            catch (error) {
                this.error = error;
            }
            finally {
                this.loading = false;
            }
        },

        async deleteItem(id) {
            this.loading = true;

            try {
                const response = await axios.delete(
                    `${API_LOCATION}/items/${id}`
                );

                const { message } = response.data;
                console.log(message);

                this.allItems = this.allItems.filter((item) => item.id !== id);
                this.userItems = this.userItems.filter(
                    (item) => item.id !== id
                );
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async updateItem(item) {
            this.loading = true;
            const userStore = useUserStore();

            try {
                const response = await axios.put(
                    `${API_LOCATION}/items/${id}`,
                    {
                        user_id: userStore.user.id,
                        ...item,
                    }
                );

                const { message } = response.data;
                console.log(message);

                this.allItems = this.allItems.map((item) =>
                    item.id === id ? itemUpdated : item
                );
                this.userItems = this.userItems.map((item) =>
                    item.id === id ? itemUpdated : item
                );
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async addItem(item) {
            this.loading = true;
            const userStore = useUserStore();

            try {
                const response = await axios.post(`${API_LOCATION}/items`, {
                    user_id: userStore.user.id,
                    ...item,
                });

                const { message, data } = response.data;
                console.log(message);

                this.allItems = [...this.allItems, { data }];
                this.userItems = [...this.userItems, { data }];
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
    },
});
