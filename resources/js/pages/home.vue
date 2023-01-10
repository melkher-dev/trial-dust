<template>
  <div>
    <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#columnModal">
      Add column
    </button>
    <div class="container">
      <div class="row">
        <div class="">
          <div v-for="column in cards" :key="column.id">
            <!-- {{ column }} -->
            <div class="card" style="width: 18rem">
              <div class="card-body">
                <h5 class="card-title">
                  {{ column.column }}
                </h5>
                <div v-for="card in column.cards" :key="card.id">
                  <p class="card-text">
                    {{ card.card }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Add column modal -->
    <div id="columnModal" class="modal fade" tabindex="-1" aria-labelledby="columnModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="columnModalLabel" class="modal-title">
              Add new title
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
          </div>
          <div class="modal-body">
            <input v-model="columnName" class="form-control" type="text">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary" @click="addColumn">
              Save column
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: 'Home' }
  },

  data () {
    return {
      cards: {},
      columnName: null,
      isModalVisible: false
    }
  },

  mounted () {
    axios.get('/api/get-cards').then(response => (this.cards = response.data))
  },

  methods: {
    addColumn () {
      axios.post('/api/save-column', { columnName: this.columnName })
    }
  }
}
</script>
