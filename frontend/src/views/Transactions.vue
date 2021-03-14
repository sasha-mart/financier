<template>
  <div>
    <div class="row col">
      <h1>Transactions</h1>
    </div>

    <transactions-creating-form />

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
      class="row col"
    >
      <transactions-table
        :transactions="transactions"
      />
    </div>
  </div>
</template>

<script>
import TransactionsTable from '../components/TransactionsTable'
import TransactionsCreatingForm from '../components/TransactionsCreatingForm'

export default {
  name: 'Transactions',
  components: {
    TransactionsCreatingForm,
    TransactionsTable
  },
  computed: {
    isLoading () {
      return this.$store.getters['transactions/isLoading']
    },
    hasError () {
      return this.$store.getters['transactions/hasError']
    },
    error () {
      return this.$store.getters['transactions/error']
    },
    hasTransactions () {
      return this.$store.getters['transactions/hasTransactions']
    },
    transactions () {
      return this.$store.getters['transactions/transactions']
    },
    categories () {
      return this.$store.getters['categories/categories']
    }
  },
  created () {
    this.$store.dispatch('transactions/findAll')
    this.$store.dispatch('categories/findAll')
  }
}
</script>
