<template>
  <div class="card w-100 mt-2">
    <div class="card-body">
      {{ amount }}
    </div>
  </div>
</template>

<script>
export default {
  name: "Transaction",
  props: {
    amount: {
      type: Number,
      required: true
    }
  }
};
</script>