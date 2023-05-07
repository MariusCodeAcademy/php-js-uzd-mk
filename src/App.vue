<template>
  <div class="container">
    <h1 class="text-3xl font-medium underline py-5">Get your Rss news Today!</h1>
    <NewsForm @rss-data="getRssData" />
    <rss-table v-if="showTable" :rss-results="rssJsonData" />
  </div>
</template>
<script>
import NewsForm from './components/NewsForm.vue'
import RssTable from './components/RssTable.vue'
export default {
  name: 'App',
  data() {
    return {
      rssJsonData: []
    }
  },
  components: {
    NewsForm,
    RssTable
  },
  methods: {
    getRssData(rssData) {
      // console.log('rssData', JSON.stringify(rssData, null, 2))
      this.rssJsonData = rssData
    }
  },
  computed: {
    showTable() {
      return !!this.rssJsonData.length
    }
  }
}
</script>
<style lang=""></style>
