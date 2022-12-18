<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the backet page

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->

<script setup>
import { storeToRefs } from "pinia";
import { ref } from "vue";
import { useStore as useItemsStore } from "../store/item.store";

const itemsStore = useItemsStore();
const { basketItems, loading, error } = storeToRefs(itemsStore);

itemsStore.fetchBasketItems();
</script>

<template>
    <h1>Mon panier</h1>

    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <div v-if="basketItems">
            <v-container>
                <v-card class="mx-auto" max-width="500">
                    <v-card-title>Mon panier</v-card-title>
                    <v-list>
                        <v-list-item
                            v-for="item in basketItems"
                            :key="item.id"
                            :title="item.name"
                            :subtitle="item.price"
                        >
                        </v-list-item>
                    </v-list>

                    <div>
                        <h4>Price :</h4>
                    </div>
                </v-card>
            </v-container>
        </div>
    </div>
</template>
<style></style>
