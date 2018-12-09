<template>
  <div>

    <h2>Books</h2>

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

    <nav aria-label="Page navigation example">

      <ul class="pagination">
        <li v-bind:class="[{disabled : !pagination.prev}]" 
            class="page-item">
          <a class="page-link" 
              href="#"
              @click="fetchBooks(pagination.prev)">
            Previous
          </a>
        </li>

        <li class="page-item disabled">
          <a class="page-link text-dark" href="#">
            Page {{ pagination.current_page }} of {{ pagination.last_page }}
          </a>
        </li>

        <li v-bind:class="[{disabled : !pagination.next}]"
            class="page-item">
          <a class="page-link" 
              href="#"
              @click="fetchBooks(pagination.next)">
            Next
          </a>
        </li>
      </ul>

    </nav>

    <div class="card card-body mb-2" 
          v-for="book in books" 
          v-bind:key="book.id">
      <h3>{{ book.title }}</h3>
      <h5>{{ book.author }}</h5>
      <small>{{ book.publishedDate }}</small>
      <small>{{ book.genre }}</small>
      <hr>
      <button class="btn btn-light"
              @click="editBook(book)">
        Edit
      </button>
      <button class="btn btn-danger"
              @click="deleteBook(book.id)">
        Delete
      </button>
    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      books     : [],
      book      : {
        id            : '',
        title         : '',
        author        : '',
        publishedDate : '',
        genre         : '',
      },
      book_id    : '',
      pagination : {},
      edit       : false,
    }
  },

  created() {
    this.fetchBooks();
  },

  methods : {
    fetchBooks(page_url) {
      let vm = this;
      page_url = page_url || 'api/books';
      fetch(page_url)
        .then(response => response.json())
        .then(result => {
          this.books = result.data;
          vm.makePagination(result.meta, result.links);
        }) 
        .catch(err => console.error(err));
    },

    makePagination(meta, links) {
      let pagination = {
        current_page : meta.current_page,
        last_page    : meta.last_page,
        next         : links.next,
        prev         : links.prev,
      }

      this.pagination = pagination;
    },

    deleteBook(id) {
      if(confirm('Are you sure?')) {
        fetch(`api/book/${id}`, {
          method : 'delete',
        })
        .then(response => response.json())
        .then(result => this.fetchBooks())
        .catch(err => console.error(err));
      }
    },

    addBook() {
      fetch('api/book', {
          method  : 'post',
          body    : JSON.stringify(this.book),
          headers : {
            'content-type' : 'application/json'
          },
        })
        .then(response => response.json())
        .then(result => {
          this.book.title = '';
          this.book.author = '';
          this.book.publishedDate = '';
          this.book.genre = '';

          this.fetchBooks();
        })
        .catch(err => console.error(err));
    },

    editBook(book) {
      this.edit = true;
      this.book.id = book.id;
      this.book.book_id = book.id;
      this.book.title = book.title;
      this.book.author = book.author;
      this.book.publishedDate = book.publishedDate;
      this.book.genre = book.genre;
    },

    saveEdit() {
      fetch('api/book', {
          method  : 'put',
          body    : JSON.stringify(this.book),
          headers : {
            'content-type' : 'application/json'
          },
        })
        .then(response => response.json())
        .then(result => {
          this.book.title = '';
          this.book.author = '';
          this.book.publishedDate = '';
          this.book.genre = '';

          this.fetchBooks();
        })
        .catch(err => console.error(err));
    },

    addOrEditBook() {
      if (this.edit === false) {
        this.addBook();
      } else {
        this.saveEdit();
      }
    }
  }
}
</script>
