import TransactionAPI from "../api/transactions";

const CREATING_TRANSACTIONS = "CREATING_TRANSACTIONS",
  CREATING_TRANSACTIONS_SUCCESS = "CREATING_TRANSACTIONS_SUCCESS",
  CREATING_TRANSACTIONS_ERROR = "CREATING_TRANSACTIONS_ERROR",
  FETCHING_TRANSACTIONS = "FETCHING_TRANSACTIONS",
  FETCHING_TRANSACTIONS_SUCCESS = "FETCHING_TRANSACTIONS_SUCCESS",
  FETCHING_TRANSACTIONS_ERROR = "FETCHING_TRANSACTIONS_ERROR";

export default {
  namespaced: true,
  state: {
    isLoading: false,
    error: null,
    transactions: []
  },
  getters: {
    isLoading(state) {
      return state.isLoading;
    },
    hasError(state) {
      return state.error !== null;
    },
    error(state) {
      return state.error;
    },
    hasTransactions(state) {
      return state.transactions.length > 0;
    },
    transactions(state) {
      return state.transactions;
    }
  },
  mutations: {
    [CREATING_TRANSACTIONS](state) {
      state.isLoading = true;
      state.error = null;
    },
    [CREATING_TRANSACTIONS_SUCCESS](state, transaction) {
      state.isLoading = false;
      state.error = null;
      state.transactions.unshift(transaction);
    },
    [CREATING_TRANSACTIONS_ERROR](state, error) {
      state.isLoading = false;
      state.error = error;
      state.transactions = [];
    },
    [FETCHING_TRANSACTIONS](state) {
      state.isLoading = true;
      state.error = null;
      state.transactions = [];
    },
    [FETCHING_TRANSACTIONS_SUCCESS](state, transactions) {
      state.isLoading = false;
      state.error = null;
      state.transactions = transactions['hydra:member'];
    },
    [FETCHING_TRANSACTIONS_ERROR](state, error) {
      state.isLoading = false;
      state.error = error;
      state.transactions = [];
    }
  },
  actions: {
    async create({ commit }, message) {
      commit(CREATING_TRANSACTIONS);
      try {
        let response = await TransactionAPI.create(message);
        commit(CREATING_TRANSACTIONS_SUCCESS, response.data);
        return response.data;
      } catch (error) {
        commit(CREATING_TRANSACTIONS_ERROR, error);
        return null;
      }
    },
    async findAll({ commit }) {
      commit(FETCHING_TRANSACTIONS);
      try {
        let response = await TransactionAPI.findAll();
        commit(FETCHING_TRANSACTIONS_SUCCESS, response.data);
        return response.data;
      } catch (error) {
        commit(FETCHING_TRANSACTIONS_ERROR, error);
        return null;
      }
    }
  }
};