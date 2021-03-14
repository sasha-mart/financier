<template>
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">
          id
        </th>
        <th scope="col">
          Date
        </th>
        <th scope="col">
          Amount
        </th>
        <th scope="col">
          Category
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="transaction in transactions"
        :key="transaction.id"
      >
        <th scope="row">
          {{ transaction.id }}
        </th>
        <td>{{ transaction.datetime }}</td>
        <td>{{ transaction.amount }}</td>
        <td>{{ transaction.category.name }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: 'TransactionsTable',
  props: {
    transactions: {
      type: Array,
      required: true
    }
  }
}
</script>
