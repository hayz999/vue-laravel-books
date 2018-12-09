<template>
  <div>

    <bookForm :addOrEditBook="addOrEditBook" 
              :book="book">
    </bookForm>

    <pagination :pagination="pagination" 
                :fetchBooks="fetchBooks">
    </pagination>

    <book v-for="(book, index) in books" :key="index" :book="book"
          :editBook="editBook"
          :deleteBook="deleteBook">
    </book>

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
