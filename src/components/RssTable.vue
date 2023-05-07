<template>
  <div class="">
    <h2 class="text-2xl font-bold mb-6">RSS Results</h2>
    <table class="table-fixed">
      <thead>
        <tr>
          <th class="px-4 py-2">Title</th>
          <th class="px-4 py-2">Description</th>
          <th class="px-4 py-2">Link</th>
          <th class="px-4 py-2">Publication Date</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(result, index) in rssResults" :key="index">
          <td class="border px-4 py-2 font-medium">{{ result.title }}</td>
          <td class="description border px-4 py-2" v-html="result.description"></td>
          <td class="border px-4 py-2">
            <a :href="result.link">link to article </a>
          </td>
          <td class="border px-4 py-2">{{ result.pubDate }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    rssResults: {
      type: Array,
      required: true
    }
  }
}
</script>

<style scope>
tbody ol,
tbody ul {
  list-style-type: disc;
  padding-left: 20px;
}
tbody a {
  text-decoration: underline;
}
</style>
