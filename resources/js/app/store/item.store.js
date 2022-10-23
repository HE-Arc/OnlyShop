import axios from "axios";
import { defineStore } from "pinia";
import { API_LOCATION } from "../constants";

const storeName = "itemStore";
const defautSate = {
    items: [],
    loading: false,
    error: null,
};

export const useStore = defineStore(storeName, {
    state: () => defautSate,
    getters: {},
    actions: {
        async fetchItems() {
            this.items = [];
            this.loading = true;

            try {
                const response = await axios.get(`${API_LOCATION}/items`);

                const { data } = response.data;
                this.items = data;
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

                this.items = this.items.filter((item) => item.id !== data.id);
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async updateItem(id, name, price) {
            this.loading = true;

            try {
                const response = await axios.put(
                    `${API_LOCATION}/items/${id}`,
                    {
                        name,
                        price,
                    }
                );

                const { message } = response.data;
                console.log(message);

                this.items = this.items.map((item) =>
                    item.id === data.id ? data : item
                );
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async addItem(name, price) {
            this.loading = true;

            try {
                const response = await axios.post(`${API_LOCATION}/items`, {
                    name,
                    price,
                });
                const { message } = response.data;
                console.log(message);

                this.items = [...this.items, { data }];
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
    },
});
