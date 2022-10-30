<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the add page

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

const addItem = (addItem) => {
    const { name, description, price } = addItem;
    itemsStore.addItem(userId, name, price, description);
    router.push("/myitems");
};
</script>

<template>
    <h1>Add View</h1>
    <v-container>
        <v-row justify="center">
            <div class="text-center">
                <v-card width="500px" height="300px">
                    <v-card-title>
                        <h1>Ajouter votre item</h1>
                    </v-card-title>

                    <v-card-text>
                        <v-form>
                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="item.name"
                                        :rules="nameRules"
                                        :counter="255"
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
                            @click="() => addItem(item)"
                        >
                            Add item
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </div>
        </v-row>
    </v-container>
</template>
