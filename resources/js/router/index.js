/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : set up the routes with vue router

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
*/
import { createRouter, createWebHistory } from "vue-router";

import Home from "../app/components/Home.vue";
import Login from "../app/components/Login.vue";
import MyItems from "../app/components/myItems.vue";
import Items from "../app/components/Items.vue";
import Panier from "../app/components/Panier.vue";
import Contact from "../app/components/Contact.vue";
import EditItem from "../app/components/EditItem.vue";


const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
        children: [
            {
                path: "/items",
                name: "items",
                component: Items,
            },
            {
                path: "myitems",
                name: "myitems",
                component: MyItems,
            },
            {
                path: "/myitems/:id",
                name: "edititem",
                component: EditItem,
            },
            {
                path: "mybacket",
                name: "mybacket",
                component: Panier,
            },
            {
                path: "contact",
                name: "contact",
                component: Contact,
            },

        ]
    },

    {
        path: '/login',
        name:'login',
        component: Login
    }
]


const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
