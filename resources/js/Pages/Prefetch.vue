<template>
  <pre>{{ props }}</pre>
</template>

<script setup>
const props = defineProps({
  dataList: Array,
})
</script>
