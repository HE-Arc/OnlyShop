<!-- CECI EST UNE CLASSE TEMPORAIRE UTILISE PAR RUI-->
<script setup>
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useStore as useItemsStore } from "./store/item.store";

const itemsStore = useItemsStore();
const { items, loading, error } = storeToRefs(itemsStore);

itemsStore.fetchItems();
</script>

<template>
    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <div v-if="items">
            <v-btn href="/item/1"><i class="material-icons"> edit </i></v-btn>
            <v-btn @click="itemsStore.deleteItem(item.id)"
                ><i class="material-icons"> delete </i></v-btn
            >
        </div>
    </div>
</template>
