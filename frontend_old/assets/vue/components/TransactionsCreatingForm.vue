<template>
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
</template>

<script>
export default {
  name: "TransactionsCreatingForm",
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
    categories() {
      return this.$store.getters["categories/categories"];
    }
  },
  created() {
    this.$store.dispatch("categories/findAll");
  },
  methods: {
    async createTransaction() {
      const result = await this.$store.dispatch("transactions/create", this.$data);
      if (result !== null) {
        this.$data.amount = "";
        this.$data.category = "";
        this.$data.initiator = "";
        this.$data.additionalInfo = "";
        this.$data.description = "";
      }
    }
  }
}
</script>

<style scoped>

</style>