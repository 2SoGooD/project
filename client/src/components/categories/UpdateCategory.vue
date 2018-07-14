<template>
<div>
        <input type="text" :placeholder="cat_title" v-model="title" @change="updateCategory(id)">
</div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'add-category',
  props: ['id', 'cat_title'],
  data () {
    return {
        title: '',
        endpoint: 'http://localhost/server/faq-category'
    }
  },
  methods: {
    updateCategory(id) {
      if (this.title) 
        // Убираем пробелы вначале и в конце строки
        this.title = this.title.replace(/^\s+|\s+$/g, '');
      if (!this.title || this.title === '') {
        return;
      } else {
        // делаем PUT запрос на сервер
        axios.put(this.endpoint + '/' + id, {
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
}
</script>

<style>
a {
    cursor: pointer;
}
</style>
