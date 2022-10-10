import { defineStore } from "pinia";
import { v4 as uuidv4 } from "uuid";

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
                const response = {
                    data: [
                        {
                            id: 1,
                            name: "Item 1",
                            price: 100,
                        },
                        {
                            id: 2,
                            name: "Item 2",
                            price: 200,
                        },
                        {
                            id: 3,
                            name: "Item 3",
                            price: 300,
                        },
                        {
                            id: 4,
                            name: "Item 4",
                            price: 400,
                        },
                        {
                            id: 5,
                            name: "Item 5",
                            price: 500,
                        },
                        {
                            id: 6,
                            name: "Item 6",
                            price: 600,
                        },
                        {
                            id: 7,
                            name: "Item 7",
                            price: 700,
                        },
                        {
                            id: 8,
                            name: "Item 8",
                            price: 800,
                        },
                    ],
                };

                const { data } = response;
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
                const response = {
                    data: {
                        id,
                        message: "Item deleted",
                    },
                };

                const { data } = response;
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
                const response = {
                    data: {
                        id,
                        name,
                        price,
                        message: "Item updated",
                    },
                };

                const { data } = response;
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
                const response = {
                    data: {
                        id: uuidv4().toString(),
                        name,
                        price,
                        message: "Item added",
                    },
                };

                const { data } = response;
                this.items = [...this.items, data];
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
    },
});
