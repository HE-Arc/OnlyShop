<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the user items

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->
<script setup>
import ItemImagesVue from "./ItemImages.vue";
import { storeToRefs } from "pinia";
import { useStore as useItemsStore } from "../store/item.store";
import AddEditDeleteToItems from "./AddEditDeleteToItems.vue";

const itemsStore = useItemsStore();
const { userItems, loading, error } = storeToRefs(itemsStore);
const colors = ["primary", "secondary", "yellow", "red", "orange"];

itemsStore.fetchUserItems();
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
                                <ItemImagesVue :item="item" />

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

                                <AddEditDeleteToItems :item="item" />
                            </v-card>
                        </v-sheet>
                    </v-col>
                </v-row>
            </v-container>
        </div>
        <div id="fixedContainer">
            <v-btn size="large" icon color="secondary">
                <router-link
                    :to="{
                        name: 'additem',
                    }"
                >
                    <i class="material-icons"> add </i>
                </router-link>
            </v-btn>
        </div>
    </div>
</template>

<style>
#fixedContainer {
    position: fixed;
    left: 85%;
    bottom: 15%;
    z-index: 1005;
}
#fixedContainer .material-icons {
    color: white;
}
</style>
