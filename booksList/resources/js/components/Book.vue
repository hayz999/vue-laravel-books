<template>
  <div class="card card-body mb-2" 
          style="margin: 0 10%;">
      <h3 class="card-title">{{ book.title }}</h3>
      <h5 class="card-title">Author: {{ book.author }}</h5>
      <small class="card-text">Date Published: {{ book.publishedDate }}</small>
      <small class="card-text">Genre: {{ book.genre }}</small>
      <hr>
      <button class="btn btn-dark mb-2"
              style="width: 10rem; background-color: #7395AE"
              @click="editBook(book)">
        Edit
      </button>
      <button class="btn btn-dark"
              style="width: 10rem;"
              @click="deleteBook(book.id)">
        Delete
      </button>
    </div>
</template>

<script>
export default {
  props : ['book', 'editBook', 'deleteBook']
}
</script>

