<template>
  <div class="flex justify-center mt-4 space-x-2" v-if="links && links.length > 0">
    <template v-for="(link, index) in links" :key="index">
      <Component
        :is="link.url ? Link : 'span'"
        :href="link.url"
        class="px-3 py-1 text-sm rounded"
        :class="{
          'bg-blue-500 text-white': link.active,
          'text-gray-500 bg-gray-100': !link.url,
          'hover:bg-blue-100': link.url
        }"
        v-html="link.label"
      />
    </template>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  links: {
    type: Array,
    default: () => []
  }
})
</script>

