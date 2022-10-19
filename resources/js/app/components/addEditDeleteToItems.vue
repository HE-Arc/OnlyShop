<!-- CECI EST UNE CLASSE TEMPORAIRE UTILISE PAR RUI-->
<script setup>
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useStore as useItemsStore } from "../store/item.store";

const itemsStore = useItemsStore();
const { items, loading, error } = storeToRefs(itemsStore);
const props = defineProps({
    item_id: Number,
});

itemsStore.fetchItems();
</script>

<template>
    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <div v-if="items">
            <v-card-action class="justify-center">
                <div class="text-center">
                    <v-btn>
                        <router-link
                            :to="{ name: 'edititem', params: { id: item_id } }"
                            ><i class="material-icons"> edit </i></router-link
                        >
                    </v-btn>
                    <v-btn @click="itemsStore.deleteItem(item_id)"
                        ><i class="material-icons"> delete </i></v-btn
                    >
                </div>
            </v-card-action>
        </div>
    </div>
</template>
