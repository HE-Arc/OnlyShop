/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : set up the routes with vue router

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
*/
import { createRouter, createWebHistory } from "vue-router";
import { useStore as userStore } from "../app/store/user.store";

// Components
import Auth from "../app/components/Auth.vue";
import MyItems from "../app/components/MyItems.vue";
import Items from "../app/components/Items.vue";
import Shopcart from "../app/components/Shopcart.vue";
import EditItem from "../app/components/EditItem.vue";
import AddItem from "../app/components/AddItem.vue";
import NotFound from "../app/components/NotFound.vue";
// Layouts
import AppLayout from "../app/layouts/AppLayout.vue";
import HomeLayout from "../app/layouts/HomeLayout.vue";

const routes = [
    {
        path: "/",
        name: "app",
        component: AppLayout,

        children: [
            {
                path: "auth",
                name: "auth",
                component: Auth,
            },
            {
                path: "home",
                name: "home",
                component: HomeLayout,
                meta: {
                    requiresAuth: true,
                },
                children: [
                    {
                        path: "items",
                        name: "items",
                        component: Items,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: "myitems",
                        name: "myitems",
                        component: MyItems,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: "myitems/:id",
                        name: "edititem",
                        component: EditItem,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: "additem",
                        name: "additem",
                        component: AddItem,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: "mybacket",
                        name: "mybacket",
                        component: Shopcart,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                ],
            },
        ],
    },
    // and finally the default route, when none of the above matches:
    {
        path: "/:pathMatch(.*)*",
        name: "notFound",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
    const isAuthenticated = userStore().user;

    // redirige / vers /auth
    if (to.path === "/") {
        if (isAuthenticated) {
            next({ name: "items" });
        } else {
            next({ name: "auth" });
        }
    }

    if (requiresAuth && !isAuthenticated) {
        next({ name: "auth" });
    } else {
        next();
    }
});

export default router;
