<template>
  <pre>{{ user }}</pre>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  user: Object,
})
</script>