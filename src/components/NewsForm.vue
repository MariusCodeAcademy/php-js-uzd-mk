<template>
  <form @submit.prevent="submitForm">
    <label>
      Keyword(s):
      <input v-model.trim="keyword" type="text" required />
    </label>

    <label>
      Language:
      <select v-model="language">
        <option value="en">English</option>
        <option value="de">German</option>
        <option value="fr">French</option>
      </select>
    </label>

    <button type="submit">Search</button>
  </form>
</template>

<script>
export default {
  name: 'NewsForm',
  data() {
    return {
      keyword: '',
      language: 'en'
    }
  },
  methods: {
    submitForm() {
      // send HTTP request to back-end with keyword and language
      this.$http
        .post('/backend/search', {
          keyword: this.keyword,
          language: this.language
        })
        .then((response) => {
          // pass response data to parent component as a custom event
          this.$emit('search-results', response.data)
        })
        .catch((error) => {
          // handle error
          console.error(error)
        })
    }
  }
}
</script>
