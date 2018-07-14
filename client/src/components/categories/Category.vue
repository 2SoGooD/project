<template>
<div>
    <div v-for="faq in faqs" :key="faq.faq_id">
        {{faq.question}} - {{faq.answer}}
    </div>
</div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'app',
  props: ['id'],
  data () {
    return {
      faqs: [],
      endpoint: 'http://localhost/server/faq-category'
    }
  },

  created() {
    this.getFaqs(this.id);
  },

  methods: {
    // Получаем список записей по id категории
    getFaqs(id) {
      axios.get(this.endpoint + '/' + id)
      .then(response => {
        this.faqs = response.data;
      })
      .catch(error => {
        console.log(error);
      })
    }
  },
  // Перерисовываем при изменении роута
  watch: {
      '$route'() {
          this.getFaqs(this.id);
      }
  }
}
</script>

<style>
a {
    cursor: pointer;
}
</style>
