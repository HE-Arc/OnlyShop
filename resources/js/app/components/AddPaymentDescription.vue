<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the payment and description buttons on the "items page"

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->
<script setup>
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useStore as useItemsStore } from "../store/item.store";

const show = ref(false);

//const { description } = defineProps(["description"]);

const itemsStore = useItemsStore();
const { item } = defineProps(["item"]);
</script>

<template>
    <v-card-actions class="justify-center">
        <div class="text-center">
            <v-btn @click="itemsStore.addItemInBasket(item.id)"
                ><i class="material-icons"> payment </i></v-btn
            >
            <v-btn @click="show = !show">
                <i v-if="show" class="material-icons"> arrow_drop_up </i>
                <i v-else class="material-icons"> arrow_drop_down </i>
            </v-btn>
        </div>
    </v-card-actions>
    <v-expand-transition>
        <div v-show="show">
            <v-divider></v-divider>
            <v-card-text>
                {{ item.attributes.description }}
            </v-card-text>
        </div>
    </v-expand-transition>
</template>
