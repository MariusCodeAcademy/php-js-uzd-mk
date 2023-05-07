<template>
  <div class="container">
    <h1 class="text-3xl font-medium underline py-5">Get your Rss news Today!</h1>
    <NewsForm @rss-data="getRssData" />
  </div>
</template>
<script>
import NewsForm from './components/NewsForm.vue'
export default {
  name: 'App',
  data() {
    return {
      rssJsonData: {}
    }
  },
  components: {
    NewsForm
  },
  methods: {
    getRssData(rssData) {
      console.log('rssData', rssData)
      this.rssJsonData = rssData
    }
  }
}
</script>
<style lang=""></style>
