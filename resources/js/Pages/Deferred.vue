<template>
  <div class="space-y-8">
    <pre>{{ user }}</pre>
    <Deferred data="expensiveData">
      <template #fallback>
        <Loader />
      </template>

      <pre>{{ expensiveData }}</pre>
    </Deferred>
  </div>
</template>

<script setup>
import { Deferred } from '@inertiajs/vue3'
import Loader from '../Shared/Loader.vue'

const props = defineProps({
  user: Object,
  expensiveData: Array,
})
</script>
