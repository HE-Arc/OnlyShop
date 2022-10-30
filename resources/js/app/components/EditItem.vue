<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the edit page

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->

<script setup>
import { ref } from "vue";
import { useStore as useItemsStore } from "../store/item.store";
import router from "./../../router";

const item = ref({
    name: "",
    description: "",
    price: "",
});

const nameRules = [
    (v) => !!v || "Name is required",
    (v) => v.length <= 15 || "Name must be less than 15 characters",
];
const descRules = [
    (v) => !!v || "Description is required",
    (v) => v.length <= 50 || "Description must be less than 50 characters",
];
const priceRules = [
    (v) => !!v || "Price is required",
    (v) => v > 0 || "Price must be greater than 0",
];

const userId = 1;
const itemsStore = useItemsStore();

const editItem = (id, updatedItem) => {
    const { name, description, price } = updatedItem;
    itemsStore.updateItem(userId, id, name, price, description);
    router.push("/myitems");
};
</script>

<template>
    <h1>Edit View</h1>
    <v-container>
        <v-row justify="center">
            <div class="text-center">
                <v-card width="500px" height="300px">
                    <v-card-title>
                        <h1>id item : {{ $route.params.id }}</h1>
                    </v-card-title>

                    <v-card-text>
                        <v-form>
                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="item.name"
                                        :rules="nameRules"
                                        :counter="15"
                                        label="New item name"
                                        required
                                    ></v-text-field>
                                </v-col>

                                <v-col>
                                    <v-text-field
                                        v-model="item.price"
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
                                        v-model="item.description"
                                        :rules="descRules"
                                        :counter="50"
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
                            @click="() => editItem($route.params.id, item)"
                        >
                            Edit item
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </div>
        </v-row>
    </v-container>
</template>
