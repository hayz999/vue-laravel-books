<template>
  <form class="mb-3 book-form"
          @submit.prevent="addOrEditBook">
    <h5>Input Book Details:</h5>
    <div class="form-group">
      <input type="text" 
              class="form-control mb-2" 
              placeholder="Book Title"
              v-model="book.title">
      <input type="text" 
              class="form-control mb-2" 
              placeholder="Author" 
              v-model="book.author">
      <input type="text" 
              class="form-control mb-2" 
              placeholder="Published Date" 
              v-model="book.publishedDate">
      <input type="text" 
              class="form-control mb-2" 
              placeholder="Genre" 
              v-model="book.genre">
    </div>
    <button type="submit"
            class="btn btn-light btn-block save-btn">
      Save
    </button>
  </form>
</template>

<script>
export default {
  props : ['addOrEditBook', 'book']
}
</script>

<style scoped>
  .book-form {
    margin: 2% 10%;
  }

  .save-btn {
    margin: 0 40%;
    width: 10rem;
  }
</style>
