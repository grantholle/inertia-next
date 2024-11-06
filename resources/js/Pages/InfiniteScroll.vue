<template>
  <table class="min-w-full divide-y divide-gray-300">
    <thead>
      <tr>
        <th scope="col" class="pb-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">ID</th>
        <th scope="col" class="px-3 pb-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
        <th scope="col" class="px-3 pb-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
      <tr v-for="user in users" :key="user.id">
        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ user.id }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ user.name }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ user.email }}</td>
      </tr>
    </tbody>
  </table>

  <WhenVisible
    :buffer="300"
    :params="{
      data: {
        page: page + 1,
      },
      only: ['users', 'page'],
      preserveUrl: true,
    }"
    always
  >
    <template #fallback>
      <Loader />
    </template>

    <div class="py-8 text-center">
      Congrats... You've scrolled infinitely
    </div>
  </WhenVisible>
</template>

<script setup>
import { WhenVisible } from '@inertiajs/vue3'
import Loader from '../Shared/Loader.vue'

const props = defineProps({
  page: Number,
  users: Array,
})

</script>
