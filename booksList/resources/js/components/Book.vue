<template>
  <div class="card card-body mb-2" 
          style="margin: 0 10%;">
      <h3 class="card-title">{{ book.title }}</h3>
      <h5 class="card-title">Author: {{ book.author }}</h5>
      <small class="card-text">Date Published: {{ book.publishedDate }}</small>
      <small class="card-text">Genre: {{ book.genre }}</small>
      <hr>
      <div class="btns">
        <button class="btn btn-dark mb-2 edit-btn"
                @click="editBook(book)">
          Edit
        </button>
        <button class="btn btn-dark delete-btn"
                @click="deleteBook(book.id)">
          Delete
        </button>
      </div>
    </div>
</template>

<script>
export default {
  props : ['book', 'editBook', 'deleteBook']
}
</script>

<style scoped>
  .btns {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  .edit-btn {
    width: 10rem;
    background-color: #7395AE;
    height: 3rem;
  }

  .delete-btn {
    width: 10rem;
    height: 3rem;
  }
</style>


