<template>
  <Deferred data="users">
    <template #fallback>
      <Loader />
    </template>

    <pre class="mb-2">{{ users }}</pre>
  </Deferred>
  <button @click="loadPage()" class="text-fuchsia-900 hover:underline">Next page</button>
</template>

<script setup>
import { router, Deferred } from '@inertiajs/vue3'
import Loader from '../Shared/Loader.vue'

const props = defineProps({
  page: Number,
  users: Array,
})
const loadPage = () => {
  router.reload({
    data: {
      page: props.page + 1,
    },
    only: ['users', 'page'],
  })
}
</script>
