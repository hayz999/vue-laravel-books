<template>
  <form class="mb-3"
          @submit.prevent="addOrEditBook">
      <div class="form-group">
        <input type="text" 
                class="form-control" 
                placeholder="Book Title"
                v-model="book.title">
        <input type="text" 
                class="form-control" 
                placeholder="Author" 
                v-model="book.author">
        <input type="text" 
                class="form-control" 
                placeholder="Published Date" 
                v-model="book.publishedDate">
        <input type="text" 
                class="form-control" 
                placeholder="Genre" 
                v-model="book.genre">
      </div>
      <button type="submit"
              class="btn btn-light btn-block">
        Save
      </button>
    </form>
</template>

<script>
export default {
  props : ['addOrEditBook', 'book']
}
</script>

