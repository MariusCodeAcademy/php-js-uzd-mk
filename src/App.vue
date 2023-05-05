<template>
  <div>
    <h1 className="text-3xl font-bold underline">Hello world!</h1>
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
