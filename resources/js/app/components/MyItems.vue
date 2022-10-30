<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the user items

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->
<script setup>
import { storeToRefs } from "pinia";
import { useStore as useItemsStore } from "../store/item.store";
import AddEditDeleteToItems from "./AddEditDeleteToItems.vue";
import AddItemForm from "./AddItemForm.vue";

const itemsStore = useItemsStore();
const { userItems, loading, error } = storeToRefs(itemsStore);
const colors = ["primary", "secondary", "yellow", "red", "orange"];

const userId = 1;
itemsStore.fetchUserItems(userId);

function addItem(user_id, item) {
    if (item) {
        const { name, price, description } = item;
        itemsStore.addItem(user_id, name, price, description);

        closeDialog();
    } else {
        alert("Please enter a valid item!");
    }
}
</script>

<template>
    <h1>Mes articles</h1>

    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <div v-if="userItems">
            <v-container>
                <v-row no-gutters>
                    <v-col
                        v-for="item in userItems"
                        :key="item.id"
                        cols="12"
                        sm="4"
                    >
                        <v-sheet class="ma-2 pa-2">
                            <v-card class="mx-auto" max-width="344">
                                <v-carousel>
                                    <v-carousel-item
                                        v-for="color in colors"
                                        :key="color"
                                    >
                                        <v-sheet
                                            :color="color"
                                            height="100%"
                                            tile
                                        >
                                            <v-row
                                                class="fill-height"
                                                align="center"
                                                justify="center"
                                            >
                                                <div class="text-h2">
                                                    {{ color }}
                                                </div>
                                            </v-row>
                                        </v-sheet>
                                    </v-carousel-item>
                                </v-carousel>

                                <v-card-title class="justify-center">
                                    <div class="text-center">
                                        {{ item.name }}
                                    </div>
                                </v-card-title>

                                <v-card-subtitle class="justify-center">
                                    <div class="text-center">
                                        {{ item.price }} CHF
                                    </div>
                                </v-card-subtitle>

                                <AddEditDeleteToItems :item_id="item.id" />
                            </v-card>
                        </v-sheet>
                    </v-col>
                </v-row>
            </v-container>

            <div id="fixedContainer">
                <AddItemForm @addItem="addItem" />
            </div>
        </div>
    </div>
</template>

<style>
#fixedContainer {
    position: fixed;
    left: 85%;
    bottom: 12%;
}
</style>
