<template>
  <div v-if="isLoading" class="fixed inset-0 bg-slate-300/40">
    <div
      class="w-2/3 fixed left-1/2 top-24 -translate-x-1/2 z-10 bg-slate-300/50 border rounded-sm p-4 flex justify-center"
    >
      <p v-if="isLoading" class="text-xl font-medium rounded-full px-4 py-1 text-blue-600">
        Loading...
      </p>
    </div>
  </div>
</template>
<script>
export default {
  name: 'CurrentState',
  props: {
    isLoading: {
      type: Boolean
    }
  }
}
</script>
