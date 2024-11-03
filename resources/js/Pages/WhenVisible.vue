<template>
  <pre>{{ alwaysLoad }}</pre>

  <h2 class="mb-[100vh] text-center text-xl py-8">Scroll down...</h2>

  <WhenVisible data="listOne">
    <template #fallback>
      <Loader />
    </template>

    <pre>{{ listOne }}</pre>
  </WhenVisible>

  <h2 class="mb-[100vh] text-center text-xl py-8">Keep going...</h2>

  <WhenVisible data="listTwo" :buffer="300">
    <template #fallback>
      <Loader />
    </template>

    <pre>{{ listTwo }}</pre>
  </WhenVisible>
</template>

<script setup>
import { WhenVisible } from '@inertiajs/vue3'
import Loader from '../Shared/Loader.vue'

const props = defineProps({
  alwaysLoad: String,
  listOne: Array,
  listTwo: Array,
})
console.log(props.listOne, props.listTwo)
</script>
