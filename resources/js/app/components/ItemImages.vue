<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the user items

Wrote by : Lucas Perrin
updated by : Lucas Perrin
-->

<script setup>
// item props
import { ref } from "vue";
import { useStore as useItemsStore } from "../store/item.store";
import { storeToRefs } from "pinia";

const { item } = defineProps(["item"]);

const itemsStore = useItemsStore();

const { loading, error } = storeToRefs(itemsStore);

// const images = await itemsStore.getAllImages(item.id);
const images = ref([]);

const imgPath = (imagepath) => {
    return "/images/" + imagepath;
};
</script>

<template>
    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <v-carousel>
            <v-carousel-item
                v-for="image in images"
                :key="image.id"
                :src="imgPath(image.attributes.imagepath)"
                reverse-transition="fade-transition"
                transition="fade-transition"
            >
            </v-carousel-item>
        </v-carousel>
    </div>
</template>
