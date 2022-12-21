import axios from "axios";
import { defineStore } from "pinia";
import { API_LOCATION } from "../constants";
//import { v4 as uuidv4 } from "uuid";
import { useStore as useUserStore } from "./user.store";

const storeName = "itemStore";
const defautSate = {
    allItems: [],
    userItems: [],
    currentEditItem: null,
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
        async fetchItem(id) {
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
        async deleteItem(id) {
            this.loading = true;

            try {
                const response = await axios.delete(
                    `${API_LOCATION}/items/${id}`
                );

                const { message } = response.data;
                console.log(message);

                // Remove the item from the array of items
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
        async updateItem(itemUpdated) {
            this.loading = true;
            const userStore = useUserStore();

            try {
                const response = await axios.put(
                    `${API_LOCATION}/items/${itemUpdated.id}`,
                    {
                        user_id: userStore.user.id,
                        name: itemUpdated.attributes.name,
                        description: itemUpdated.attributes.description,
                        price: itemUpdated.attributes.price,
                    }
                );

                const { message } = response.data;
                console.log(message);

                // Replace the item in the array with the updated item
                this.allItems = this.allItems.map((item) =>
                    item.id === itemUpdated.id ? itemUpdated : item
                );
                this.userItems = this.userItems.map((item) =>
                    item.id === itemUpdated.id ? itemUpdated : item
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

                const { message } = response.data;
                console.log(message);

                const { data } = response.data;

                // Store the images
                for (const image of item.images) {
                    const formData = new FormData();

                    formData.append("item_id", data.id);
                    formData.append("imagepath", image);

                    await axios.post(`${API_LOCATION}/images`, formData);
                }

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
