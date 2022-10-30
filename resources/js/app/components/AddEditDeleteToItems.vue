<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the edit and delete buttons for the "myitems page"

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->
<script setup>
import { useStore as useItemsStore } from "../store/item.store";

const itemsStore = useItemsStore();
const props = defineProps({
    item_id: Number,
});
</script>

<template>
    <v-card-actions class="justify-center">
        <div class="text-center">
            <v-btn>
                <router-link :to="{ name: 'edititem', params: { id: item_id } }"
                    ><i class="material-icons"> edit </i>
                </router-link>
            </v-btn>
            <v-btn @click="itemsStore.deleteItem(item_id)"
                ><i class="material-icons"> delete </i></v-btn
            >
        </div>
    </v-card-actions>
</template>
