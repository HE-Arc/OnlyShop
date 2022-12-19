<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show item images

Wrote by : Lucas Perrin
updated by : Lucas Perrin
-->

<script setup>
// item props
import { ref } from "vue";
import { useStore as useImageStore } from "../store/image.store";

const { item } = defineProps(["item"]);

const imageStore = useImageStore();

const path = (imagepath) => {
    console.log("http://localhost:8000/images/" + imagepath);
    return "http://localhost:8000/images/" + imagepath;
};

const images = ref([]);

// enclose in an async function to use await
(async () => {
    images.value = await imageStore.getAllImages(item.id);
})();
</script>

<template>
    <div v-if="images.length">
        <v-carousel>
            <v-carousel-item
                v-for="image in images"
                :key="image.id"
                :src="path(image.attributes.imagepath)"
                reverse-transition="fade-transition"
                transition="fade-transition"
            >
            </v-carousel-item>
        </v-carousel>
    </div>
</template>
