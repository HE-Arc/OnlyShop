<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the backet page

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->

<script setup>
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useStore as useItemsStore } from "../store/item.store";
import addPaymentDescription from "./AddPaymentDescription.vue";

const itemsStore = useItemsStore();
const { items, loading, error } = storeToRefs(itemsStore);
const colors = ["primary", "secondary", "yellow", "red", "orange"];

itemsStore.fetchItems();
</script>

<template>
    <h1>Mon panier</h1>
    <v-card class="mx-auto" max-width="300">
        <v-list :items="items"></v-list>
    </v-card>
</template>
