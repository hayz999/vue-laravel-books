<template>
  <nav>

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
</template>

<script>
export default {
  props : ['pagination', 'fetchBooks']
}
</script>

