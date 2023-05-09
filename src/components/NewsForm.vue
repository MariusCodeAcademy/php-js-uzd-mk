<template>
  <form
    class="border border-neutral-300 px-6 py-6 rounded-sm shadow-md shadow-gray-200 transition-shadow duration-300 hover:shadow-lg"
    @submit.prevent="submitForm"
  >
    <label class="mb-3 block">
      Keyword(s):
      <input
        :class="['input w-full', keywordError ? 'border-red-500' : 'border-gray-300']"
        v-model.trim="keyword"
        type="text"
      />
      <span class="text-red-600" v-if="keywordError"
        >Keyword must be at least 3 characters long</span
      >
    </label>

    <label>
      Language:
      <select class="input w-full border-gray-300 mb-5 transition transition-" v-model="language">
        <option value="en">English</option>
        <option value="de">German</option>
        <option value="fr">French</option>
      </select>
    </label>

    <button :disabled="isLoading" class="px-4 py-1 border rounded-md border-gray-400" type="submit">
      {{ isLoading ? 'Loading...' : 'Search' }}
    </button>
  </form>
</template>

<script>
let backendUrl = '/backend/src/search.php'

// backendUrl = 'rss.json'
export default {
  name: 'NewsForm',
  props: {
    isLoading: Boolean
  },
  data() {
    return {
      keyword: 'ai',
      language: 'en',
      keywordError: false
    }
  },
  methods: {
    async submitForm() {
      // validate keyword input
      if (this.keyword === '' || this.keyword.length < 2) {
        this.keywordError = true
        return
      } else {
        this.keywordError = false
      }

      const rssRequestObj = {
        keyword: this.keyword,
        language: this.language
      }
      try {
        this.$emit('is-loading-form', true)
        const response = await fetch(backendUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(rssRequestObj)
        })

        if (!response.ok) {
          throw new Error('Failed to retrieve search results')
        }

        const responseData = await response.json()

        // pass response data to parent component as a custom event
        this.$emit('rss-data', responseData)
        this.$emit('search', rssRequestObj)
      } catch (error) {
        // handle error
        console.error(error)
      } finally {
        this.$emit('isLoadingForm', false)
      }
    }
  },
  emits: ['is-loading-form', 'rss-data', 'search']
}
</script>
