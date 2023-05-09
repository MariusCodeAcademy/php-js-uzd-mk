<template>
  <div v-if="isLoading" class="fixed inset-0 bg-slate-300/40">
    <div
      class="w-2/3 fixed left-1/2 top-24 -translate-x-1/2 z-10 bg-slate-300/50 border rounded-sm p-4 flex justify-center"
    >
      <p v-if="isLoading" class="text-xl font-medium rounded-full px-4 py-1 text-blue-600">
        Loading...
      </p>
      <!-- <p v-if="state.value === error" class="text-xl font-medium text-red-500 border-y-2 px-4 py-1">
        Error
      </p>
      <p v-if="state.value === ready" class="text-xl font-medium rounded-r-full border-2 px-4 py-1">
        Ready
      </p> -->
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
<style></style>
