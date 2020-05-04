import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home";
import Transactions from "../views/Transactions";

Vue.use(VueRouter);

export default new VueRouter({
  mode: "history",
  routes: [
    { path: "/home", component: Home },
    { path: "/transactions", component: Transactions },
    { path: "*", redirect: "/home" }
  ]
});