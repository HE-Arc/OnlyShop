<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show item images

Wrote by : Lucas Perrin
updated by : Lucas Perrin
-->

<script setup>
import { ref } from "vue";
import { useStore as useImageStore } from "../store/image.store";

const { item } = defineProps(["item"]);

const imageStore = useImageStore();

const path = (imagepath) => {
    return "/images/" + imagepath;
};

const images = ref([]);

// enclose in an async function to use await
(async () => {
    images.value = await imageStore.getAllImages(item.id);
})();

// ⚠️ For the moment we only show the first image --> sufficiant for the shopcart
</script>

<template>
    <div v-if="images.length">
        <!-- center horizontaly in the div -->
        <div class="d-flex justify-center">
            <v-img
                :src="path(images[0].attributes.imagepath)"
                :aspect-ratio="16 / 9"
                :max-height="200"
                :max-width="200"
                contain
            ></v-img>
        </div>
    </div>
</template>
