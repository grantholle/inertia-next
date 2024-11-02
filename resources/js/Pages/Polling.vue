<template>
  <div class="flex items-center gap-2">
    <button @click="stop()" class="text-fuchsia-900 hover:underline">Stop polling</button>
    <button @click="start()" class="text-fuchsia-900 hover:underline">Start polling</button>
  </div>
  <pre class="mt-2">{{ props }}</pre>
</template>

<script setup>
import { usePoll } from '@inertiajs/vue3'

const props = defineProps({
  time: String,
  user: Object,
})
const { start, stop } = usePoll(1000, {
  only: ['time'],
})
</script>
