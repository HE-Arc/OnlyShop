import axios from "axios";
import { defineStore } from "pinia";
import { API_LOCATION } from "../constants";
//import { v4 as uuidv4 } from "uuid";

const storeName = "itemStore";
const defautSate = {
    allItems: [],
    userItems: [],
    loading: false,
    error: null,
};

export const useStore = defineStore(storeName, {
    state: () => defautSate,
    getters: {},
    actions: {
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
        async fetchUserItems(userId) {
            this.userItems = [];
            this.loading = true;

            try {
                const response = await axios.get(
                    `${API_LOCATION}/items/getUserItems/${userId}`
                );

                const { items } = response.data;
                this.userItems = items;
            } catch (error) {
                this.error = error;
            } finally {
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
        async updateItem(userId, id, name, price, description) {
            this.loading = true;

            try {
                const itemUpdated = {
                    id,
                    name,
                    price,
                    description,
                };

                const response = await axios.put(
                    `${API_LOCATION}/items/${id}`,
                    {
                        user_id : userId,
                        ...itemUpdated,
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
        async addItem(userId, name, price, description) {
            this.loading = true;

            try {
                const item = {
                    name,
                    price,
                    description,
                };
                const response = await axios.post(`${API_LOCATION}/items`, {
                    user_id: userId,
                    ...item,
                });

                const { message, item_id } = response.data;
                console.log(message);

                this.allItems = [...this.allItems, { id: item_id, ...item }];
                this.userItems = [...this.userItems, { id: item_id, ...item }];
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
    },
});
