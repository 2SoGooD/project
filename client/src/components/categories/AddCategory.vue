<template>
<div>
        <input type="text" name="title" v-model="title" @change="addCategory()">
</div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'add-category',
  data () {
    return {
        title: '',
        endpoint: 'http://localhost/server/faq-category'
    }
  },

  methods: {
    // Добавляем категорию
    addCategory() {
    axios.post(this.endpoint, {
        title: this.title
    })
      .then(response => {
        console.log(response.data);
        this.title = '';
      })
      .catch(error => {
        console.log(error);
      })
    }
  }
}
</script>

<style>
a {
    cursor: pointer;
}
</style>
