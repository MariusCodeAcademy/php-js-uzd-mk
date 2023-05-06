<template>
  <div class="container">
    <h1 class="text-3xl font-medium underline py-5">Get your Rss news Today!</h1>
    <NewsForm />
  </div>
</template>
<script>
import NewsForm from './components/NewsForm.vue'
export default {
  name: 'App',
  components: {
    NewsForm
  }
}
</script>
<style lang=""></style>
