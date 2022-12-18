<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show all the items

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->
<script setup>
import { storeToRefs } from "pinia";
import { useStore as useItemsStore } from "../store/item.store";
import AddPaymentDescription from "./AddPaymentDescription.vue";

const itemsStore = useItemsStore();
const { allItems, loading, error } = storeToRefs(itemsStore);
const colors = ["primary", "secondary", "yellow", "red", "orange"];

itemsStore.fetchAllItems();
</script>

<template>
    <h1>Tous les articles</h1>

    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <div v-if="allItems">
            <v-container>
                <v-row no-gutters>
                    <v-col
                        v-for="item in allItems"
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
                                        {{ item.attributes.name }}
                                    </div>
                                </v-card-title>

                                <v-card-subtitle class="justify-center">
                                    <div class="text-center">
                                        {{ item.attributes.price }} CHF
                                    </div>
                                </v-card-subtitle>

                                <AddPaymentDescription
                                    :description="item.attributes.description"
                                />
                            </v-card>
                        </v-sheet>
                    </v-col>
                </v-row>
            </v-container>
        </div>
    </div>
</template>

<style>
.v-carousel {
    height: 300px !important;
}
</style>
