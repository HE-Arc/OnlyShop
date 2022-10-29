<template>
    <div class="text-center">
        <v-dialog v-model="dialog" width="500">
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    dark
                    v-bind="attrs"
                    @click.stop="dialog = true"
                    icon="mdi-plus"
                >
                </v-btn>
            </template>

            <v-card>
                <v-card-title class="text-h5 grey lighten-2">
                    Add your new item
                </v-card-title>

                <v-card-text>
                    <v-form v-model="valid">
                        <v-row>
                            <v-col>
                                <v-text-field
                                    v-model="item.name"
                                    :rules="nameRules"
                                    :counter="15"
                                    label="Item name"
                                    required
                                ></v-text-field>
                            </v-col>

                            <v-col>
                                <v-text-field
                                    v-model="item.price"
                                    :rules="priceRules"
                                    label="Item price"
                                    type="number"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-text-field
                                    v-model="item.description"
                                    :rules="descRules"
                                    :counter="50"
                                    label="Item description"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="dialog = false">
                        Close
                    </v-btn>
                    <v-btn
                        color="primary"
                        text
                        @click="dialog = false"
                        v-on:click="$emit('item', this.item)"
                    >
                        Accept
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dialog: false,
            valid: false,
            item: {
                name: "",
                description: "",
                price: "",
            },
            nameRules: [
                (v) => !!v || "Name is required",
                (v) => v.length <= 15 || "Name must be less than 15 characters",
            ],
            descRules: [
                (v) => !!v || "Description is required",
                (v) =>
                    v.length <= 50 ||
                    "Description must be less than 50 characters",
            ],
            priceRules: [(v) => !!v || "Price is required"],
        };
    },
};
</script>
