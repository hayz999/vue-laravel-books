<template>
  <div class="main-container">

    <button class="btn btn-dark add-btn" 
            @click="shouldShowForm"
            v-if="!showForm">
      Add A Book
    </button>

    <div class="author-filter">
      <label>Filter By Author: </label>
      <input<input type="text" 
              class="form-control mb-2 filter" 
              placeholder="Author Name"
              v-model="authorName">
    </div>

    <div v-if="showForm">
      <bookForm :addOrEditBook="addOrEditBook" 
                :book="book">
      </bookForm>
    </div>

    <book v-for="(book, index) in filterByAuthor" :key="index" :book="book"
          :editBook="editBook"
          :deleteBook="deleteBook">
    </book>

    <pagination :pagination="pagination" 
                :fetchBooks="fetchBooks">
    </pagination>

  </div>
</template>

<script>
import BookForm   from './BookForm';
import Book       from './Book';
import Pagination from './Pagination';

export default {
  components : {
    BookForm,
    Book,
    Pagination
  },

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
      showForm   : false,
      authorName : '',
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
          this.showForm = !this.showForm;

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
      this.showForm = !this.showForm;
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
          this.showForm = !this.showForm;

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
    },

    shouldShowForm() {
      this.showForm = !this.showForm;
    },
  },

  computed: {
    filterByAuthor() {
      return this.books.filter(book => {
        return book.author.toLowerCase().includes(this.authorName.toLowerCase());
      });
    }
  }
}
</script>

<style scoped>
  .add-btn {
    margin: 2% 0 2% 80%;
  }

  .main-container {
    width:100%;
  }

  .author-filter{
    margin: 0 10%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  .filter {
    width: 80%;
  }
</style>

