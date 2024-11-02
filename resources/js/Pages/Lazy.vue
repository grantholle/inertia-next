<template>
  <Link href="/lazy" :only="['list']" class="text-fuchsia-900 hover:underline">Load the list</Link>
  <pre class="mt-2">{{ props }}</pre>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  value: String,
  list: Array,
})
</script>
