<template>
  <div class="container">
    <CurrentState :isLoading="isLoading" />
    <h1 class="text-3xl font-medium underline py-5">Get your Rss news Today!</h1>
    <NewsForm
      :isLoading="isLoading"
      @isLoadingForm="handleFormLoading"
      @search="updateSearch"
      @rss-data="getRssData"
    />
    <rss-table
      :isLoading="isLoading"
      :values="{ search, lang }"
      v-if="showTable"
      :rss-results="rssJsonData"
    />
  </div>
</template>
<script>
import NewsForm from './components/NewsForm.vue'
import RssTable from './components/RssTable.vue'
import CurrentState from './components/CurrentState.vue'

export default {
  name: 'App',
  data() {
    return {
      rssJsonData: [],
      search: '',
      lang: '',
      isLoading: false
    }
  },
  components: {
    NewsForm,
    RssTable,
    CurrentState
  },
  methods: {
    getRssData(rssData) {
      // console.log('rssData', JSON.stringify(rssData, null, 2))
      this.rssJsonData = rssData
    },
    updateSearch({ keyword, language }) {
      this.search = keyword
      this.lang = language
    },
    handleFormLoading(loadingValue) {
      this.isLoading = loadingValue
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
