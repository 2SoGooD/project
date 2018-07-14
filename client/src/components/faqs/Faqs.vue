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
  data () {
    return {
      faqs: [],
      endpoint: 'http://localhost/server/faqs'
    }
  },

  created() {
    this.getFaqs();
  },

  methods: {
    // Делаем запрос на сервер, получаем записи
    getFaqs() {
      axios.get(this.endpoint)
      .then(response => {
        this.faqs = response.data;
      })
      .catch(error => {
        console.log(error);
      })
    }
  }
}
</script>
