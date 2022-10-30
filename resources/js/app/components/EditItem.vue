<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the edit page

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->

<script setup>
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useStore as useItemsStore } from "../store/item.store";
import router from "./../../router";

const nameRules = [
    (v) => !!v || "Name is required",
    (v) => v.length <= 255 || "Name must be less than 255 characters",
];
const descRules = [
    (v) => !!v || "Description is required",
    (v) => v.length <= 1000 || "Description must be less than 1000 characters",
];
const priceRules = [
    (v) => !!v || "Price is required",
    (v) => v > 0 || "Price must be greater than 0",
];

const userId = 1;
const itemsStore = useItemsStore();

const { currentEditItem, loading, error } = storeToRefs(itemsStore);

itemsStore.setCurrentEditItem(router.currentRoute.value.params.id);

const editItem = (id, updatedItem) => {
    const { name, description, price } = updatedItem;
    itemsStore.updateItem(userId, id, name, price, description);
    router.push("/myitems");
};
</script>

<template>
    <h1>Edit View</h1>

    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <div v-if="currentEditItem">
            <v-container>
                <v-row justify="center">
                    <div class="text-center">
                        <v-card width="500px" height="300px">
                            <v-card-title>
                                <h1>Update Item</h1>
                            </v-card-title>

                            <v-card-text>
                                <v-form>
                                    <v-row>
                                        <v-col>
                                            <v-text-field
                                                v-model="currentEditItem.name"
                                                :rules="nameRules"
                                                :counter="255"
                                                label="New item name"
                                                required
                                            ></v-text-field>
                                        </v-col>

                                        <v-col>
                                            <v-text-field
                                                v-model="currentEditItem.price"
                                                :rules="priceRules"
                                                label="New item price"
                                                type="number"
                                                min="0"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col>
                                            <v-text-field
                                                v-model="
                                                    currentEditItem.description
                                                "
                                                :rules="descRules"
                                                :counter="1000"
                                                label="New item description"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-form>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="primary"
                                    text
                                    @click="
                                        () =>
                                            editItem(
                                                $route.params.id,
                                                currentEditItem
                                            )
                                    "
                                >
                                    Edit item
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </div>
                </v-row>
            </v-container>
        </div>
    </div>
</template>
