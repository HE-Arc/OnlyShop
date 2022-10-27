<script setup>
import { storeToRefs } from "pinia";
import { Form, Field, ErrorMessage } from "vee-validate";
import * as Yup from "yup";
import { useStore as useItemsStore } from "./store/item.store";

const itemsStore = useItemsStore();
const { items, loading, error } = storeToRefs(itemsStore);

const schema = Yup.object().shape({
    name: Yup.string().required("Name is required"),
    price: Yup.number().required("Price is required"),
});

const onSubmitEdit = async (values) => {
    const { id, name, price } = values;
    itemsStore.updateItem(id, name, price);
};

const onSubmitAdd = async (values) => {
    const { name, price } = values;
    itemsStore.addItem(name, price);
};

itemsStore.fetchItems();
</script>

<template>
    <p>Items</p>

    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <div v-if="items">
            <div v-for="item in items" :key="item.id">
                <Form
                    @submit="onSubmitEdit"
                    :validation-schema="schema"
                    :initial-values="item"
                    v-slot="{ errors, isSubmitting }"
                >
                    <Field name="name" type="text" />
                    <ErrorMessage name="name" />

                    <Field name="price" type="number" />
                    <ErrorMessage name="price" />

                    <button type="submit" :disabled="isSubmitting">✅</button>
                </Form>
                <button @click="itemsStore.deleteItem(item.id)">❌</button>
            </div>
        </div>

        <Form
            @submit="onSubmitAdd"
            :validation-schema="schema"
            v-slot="{ errors, isSubmitting }"
        >
            <Field name="name" type="text" placeholder="name" />
            <ErrorMessage name="name" />

            <Field name="price" type="number" placeholder="price" />
            <ErrorMessage name="price" />

            <button type="submit" :disabled="isSubmitting">Add</button>
        </Form>
    </div>
</template>
