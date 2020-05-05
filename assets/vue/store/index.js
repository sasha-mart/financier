import Vue from "vue";
import Vuex from "vuex";
import TransactionModule from "./transactions";
import CategoryModule from "./categories";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    transactions: TransactionModule,
    categories: CategoryModule
  }
});