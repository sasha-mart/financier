<template>
  <div>
    <div class="row col">
      <h1>Transactions</h1>
    </div>

    <div class="row col">
      <form>
        <div class="form-row">
          <div class="col-8">
            <input
              v-model="amount"
              type="text"
              class="form-control"
            >
          </div>
          <div class="col-4">
            <button
              :disabled="amount.length === 0 || isLoading"
              type="button"
              class="btn btn-primary"
              @click="createTransaction()"
            >
              Create
            </button>
          </div>
        </div>
      </form>
    </div>

    <div
      v-if="isLoading"
      class="row col"
    >
      <p>Loading...</p>
    </div>

    <div
      v-else-if="hasError"
      class="row col"
    >
      <div
        class="alert alert-danger"
        role="alert"
      >
        {{ error }}
      </div>
    </div>

    <div
      v-else-if="!hasTransactions"
      class="row col"
    >
      No transactions!
    </div>

    <div
      v-for="transaction in transactions"
      v-else
      :key="transaction.id"
      class="row col"
    >
      <transaction :amount="transaction.amount" />
    </div>
  </div>
</template>

<script>
import Transaction from "../components/Transaction";

export default {
  name: "Transactions",
  components: {
    Transaction
  },
  data() {
    return {
      amount: ""
    };
  },
  computed: {
    isLoading() {
      return this.$store.getters["transactions/isLoading"];
    },
    hasError() {
      return this.$store.getters["transactions/hasError"];
    },
    error() {
      return this.$store.getters["transactions/error"];
    },
    hasTransactions() {
      return this.$store.getters["transactions/hasTransactions"];
    },
    transactions() {
      return this.$store.getters["transactions/transactions"];
    }
  },
  created() {
    this.$store.dispatch("transactions/findAll");
  },
  methods: {
    async createTransaction() {
      const result = await this.$store.dispatch("transactions/create", this.$data);
      if (result !== null) {
        this.$data.amount = "";
      }
    }
  }
};
</script>