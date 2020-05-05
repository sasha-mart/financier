<template>
  <div class="card w-100 mt-2">
    <div class="card-body">
      {{ transaction.datetime }}
      {{ transaction.amount }}
    </div>
  </div>
</template>

<script>
export default {
  name: "Transaction",
  props: {
    transaction: {
      type: Object,
      required: true
    }
  }
};
</script>