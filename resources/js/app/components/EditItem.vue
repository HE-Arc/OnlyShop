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

let form = ref(false);
let isLoading = ref(false);

let rules = {
    length: (v) => (v || "").length >= 3 || "Must be at least 3 characters",
    name: (v) =>
        !!(v || "").match(/^[a-zA-Z0-9 ]*$/) || "Please enter a valid name",
    price: (v) => !!(v || "").match(/^[0-9]*$/) || "Please enter a valid price",
    description: (v) =>
        !!(v || "").match(/^[a-zA-Z0-9 ]*$/) ||
        "Please enter a valid description",
    required: (v) => !!v || "This field is required",
};

const itemsStore = useItemsStore();

// Fetch the item to edit according to the id in the route ⚠️
itemsStore.fetchItem(router.currentRoute.value.params.id);

const { currentEditItem, loading, error } = storeToRefs(itemsStore);

const editItem = async () => {
    await itemsStore.updateItem(currentEditItem.value);
    router.push({ name: "myitems" });
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
                        <v-card>
                            <v-card-title>
                                <h1>Update Item</h1>
                            </v-card-title>

                            <v-card-text>
                                <v-form v-model="form">
                                    <v-row>
                                        <v-col>
                                            <v-text-field
                                                v-model="
                                                    currentEditItem.attributes
                                                        .name
                                                "
                                                :rules="[
                                                    rules.length,
                                                    rules.name,
                                                    rules.required,
                                                ]"
                                                label="New item name"
                                                required
                                            ></v-text-field>
                                        </v-col>

                                        <v-col>
                                            <v-text-field
                                                v-model="
                                                    currentEditItem.attributes
                                                        .price
                                                "
                                                :rules="[
                                                    rules.price,
                                                    rules.required,
                                                ]"
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
                                                    currentEditItem.attributes
                                                        .description
                                                "
                                                :rules="[
                                                    rules.length,
                                                    rules.description,
                                                    rules.required,
                                                ]"
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
                                    :disabled="
                                        currentEditItem.attributes.name == '' ||
                                        currentEditItem.attributes.price ==
                                            '' ||
                                        currentEditItem.attributes
                                            .description == ''
                                    "
                                    :loading="isLoading"
                                    color="primary"
                                    @click="() => editItem()"
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
