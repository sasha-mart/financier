<template>
  <div>
    <div class="row col">
      <h1>Transactions</h1>
    </div>

    <form>
      <div class="form-row">
        <div class="form-group col-4">
          <label
            for="transaction-amount"
          >Amount</label>
          <input
            id="transaction-amount"
            v-model.number="amount"
            placeholder="Amount"
            type="number"
            class="form-control"
          >
        </div>
        <div class="form-group col-4">
          <label for="transaction-category">Category</label>
          <select
            id="transaction-category"
            v-model="category"
            class="form-control"
          >
            <option
              v-for="categoryItem in categories"
              :key="categoryItem.id"
              :value="categoryItem['@id']"
            >
              {{ categoryItem.name }}
            </option>
          </select>
        </div>
        <div class="form-group col-4">
          <label
            for="transaction-datetime"
          >Date</label>
          <input
            id="transaction-datetime"
            v-model="datetime"
            type="date"
            class="col-4 form-control"
          >
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-4">
          <label for="transaction-initiator">Initiator</label>
          <input
            id="transaction-initiator"
            v-model.trim="initiator"
            type="text"
            class="form-control"
          >
        </div>
        <div class="form-group col-4">
          <label for="transaction-description">Description</label>
          <input
            id="transaction-description"
            v-model.trim="description"
            type="text"
            class="form-control"
          >
        </div>
        <div class="form-group col-4">
          <label for="transaction-additionalInfo">Additional info</label>
          <input
            id="transaction-additionalInfo"
            v-model.trim="additionalInfo"
            type="text"
            class="form-control"
          >
        </div>
      </div>
      <div class="form-row">
        <button
          :disabled="amount.length === 0 || datetime === null || category.length === null || isLoading"
          type="button"
          class="btn btn-primary"
          @click="createTransaction()"
        >
          Create
        </button>
      </div>
    </form>

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
      <transaction
        :transaction="transaction"
      />
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
      amount: "",
      datetime: null,
      category: "",
      initiator: "",
      description: "",
      additionalInfo: ""
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
    },
    categories() {
      return this.$store.getters["categories/categories"];
    }
  },
  created() {
    this.$store.dispatch("transactions/findAll");
    this.$store.dispatch("categories/findAll");
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