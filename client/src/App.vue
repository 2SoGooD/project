<template>
  <div id="app">
    <div class="navbar">
      <router-link
        active-class="active"
        :to = "{name: 'faqs'}">
        Список записей
      </router-link>
      <router-link
        active-class="active"
        :to = "{name: 'add_category'}">
        Добавить категорию
      </router-link>
    </div>
    <div class="categories">
        <router-link 
          v-for="cat in categories"
          :key="cat.cat_id"
          active-class="active"
           class="link"
          :to = "{name: 'faq', params: {id : cat.cat_id}}">
          {{cat.title}} - 
          <router-link
            active-class="active"
            :to = "{name: 'update_category', params: {id: cat.cat_id, cat_title: cat.title}}">
            <small>Изменить</small>
          </router-link>
          <a v-on:click="delCategory(cat.cat_id)"><small>Удалить</small></a>
        </router-link>
    </div>
    <div class="faqs">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'app',

  data () {
    return {
      categories: [],
      endpoint: 'http://localhost/server/faq-categories',
      actionurl: 'http://localhost/server/faq-category',
    }
  },

  created() {
    this.getCategories();
  },

  methods: {
    // Получаем список категорий от сервера
    getCategories() {
      axios.get(this.endpoint)
      .then(response => {
        this.categories = response.data;
      })
      .catch(error => {
        console.log(error);
      })
    },
    // Удаляем категорию
    delCategory(id) {
        axios.delete(this.actionurl + '/' + id)
        .then(response => {
            console.log('OK ' + response);
        })
        .catch(error => {
            console.log(error);
        })
    }
  },
  // Наблюдаем за массивом категорий, при изменении перерисовывем
  watch: {
      categories: function() {
          this.getCategories();
      }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin: 30px;
}
.navbar {
  display: block;
  width: 100%;
}
.navbar a {
  margin: 0 10px;
}
.categories {
  display: block;
  margin: 30px 0;
  float: left;
}
.categories .link {
  display: block;
  width: 200px;
  float: left;
  text-decoration: none;
}
.categories .link a:hover {
  text-decoration: underline;
}
.faqs {
  display: block;
  width: 100%;
  margin: 10px;
  float: left;
}
</style>
