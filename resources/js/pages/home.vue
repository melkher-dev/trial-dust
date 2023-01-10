<template>
  <div>
    <!-- <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#columnModal">
      Add column
    </button>
    <div class="container">
      <div class="row">
        <div class="">
          <div v-for="column in cards" :key="column.id">
            <div class="card" style="width: 18rem">
              <div class="card-body">
                <div>
                  <h5 class="card-title">
                    {{ column.name }}
                  </h5>
                  <button
                    type="button"
                    class="btn btn-primary m-2"
                    data-bs-toggle="modal"
                    data-bs-target="#cardModal"
                    @click="showAddCardModal(column)"
                  >
                    Add card
                  </button>
                </div>
                <div v-for="card in column.cards" :key="card.id">
                  <div>
                    <p class="card-text">
                      {{ card.name }}
                    </p>
                    <button
                      type="button"
                      class="btn btn-primary m-2"
                      data-bs-toggle="modal"
                      data-bs-target="#editCardModal"
                      @click="showEditCardModal(card)"
                    >
                      Edit card
                    </button>
                    <button class="btn btn-danger" @click="deleteCard(card.id)">
                      Delete card
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <!-- Add column modal -->
    <!-- <div id="columnModal" class="modal fade" tabindex="-1" aria-labelledby="columnModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="columnModalLabel" class="modal-title">
              Add new column
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
    </div> -->

    <!-- Add card modal -->
    <!-- <div id="cardModal" class="modal fade" tabindex="-1" aria-labelledby="cardModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="cardModalLabel" class="modal-title">
              Add new card
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
          </div>
          <div class="modal-body">
            <input v-model="cardForm.name" class="form-control m-2" type="text" placeholder="Card name">
            <input v-model="cardForm.description" class="form-control m-2" type="text" placeholder="Card description">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary" @click="addCard">
              Save card
            </button>
          </div>
        </div>
      </div>
    </div> -->

    <!-- Edit card modal -->
    <!-- <div id="editCardModal" class="modal fade" tabindex="-1" aria-labelledby="editCardModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="editCardModalLabel" class="modal-title">
              Add new card
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
          </div>
          <div v-if="updateCardForm.cardId" class="modal-body">
            <input v-model="updateCardForm.name" class="form-control m-2" type="text">
            <input v-model="updateCardForm.description" class="form-control m-2" type="text">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary" @click="editCard">
              Edit card
            </button>
          </div>
        </div>
      </div>
    </div> -->

    <KanbanBoard />
  </div>
</template>

<script>
import KanbanBoard from '../components/KanbanBoard'
export default {
  components: { KanbanBoard },
  middleware: 'auth',

  metaInfo () {
    return { title: 'Home' }
    // },

    // data () {
    //   return {
    //     cards: {},
    //     columnName: null,
    //     isModalVisible: false,
    //     cardForm: {
    //       columnId: null,
    //       description: null,
    //       name: null
    //     },
    //     updateCardForm: {
    //       name: null,
    //       description: null,
    //       cardId: null
    //     }
    //   }
    // },

    // mounted () {
    //   axios.get('/api/index').then(response => (this.cards = response.data))
    // },

  // methods: {
  //   addColumn () {
  //     axios.post('/api/columns', { name: this.columnName })
  //   },
  //   showAddCardModal (column) {
  //     this.cardForm.columnId = column.id
  //   },
  //   showEditCardModal (card) {
  //     this.updateCardForm.cardId = card.id
  //     this.updateCardForm.name = card.name
  //     this.updateCardForm.description = card.description
  //   },
  //   addCard () {
  //     axios.post('/api/cards', this.cardForm)
  //   },
  //   editCard () {
  //     axios.put('/api/cards', this.updateCardForm)
  //   },
  //   deleteCard (id) {
  //     axios.delete(`/api/cards/${id}`)
  //   }
  // }
  }
}
</script>
