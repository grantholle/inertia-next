<template>
  <div class="flex flex-col min-h-screen px-4">
    <main class="flex-1 py-20 grid grid-cols-4 gap-6 max-w-7xl mx-auto w-full">
      <nav>
        <ul class="rounded-xl bg-white/30 backdrop-blur-sm shadow-lg p-3 space-y-2">
          <li v-for="link in links" :key="link.href">
            <Link :href="link.href" :class="['flex px-3 py-1 rounded transition', link.current ? 'bg-[#6d74ed] text-white' : 'hover:bg-gray-100/20']">
              {{ link.text }}
            </Link>
          </li>
        </ul>
      </nav>
      <section class="col-span-3 w-full">
        <div class="rounded-xl bg-white/30 backdrop-blur-sm px-6 py-5 shadow-lg">
          <slot />
        </div>
      </section>
    </main>
  </div>
</template>

<script setup>
import { usePage, Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const links = computed(() => usePage().props.links)
</script>