<template>
  <div class="ui">
    <nav class="">
      <button type="button" class="btn btn-dark m-2"
              @click="showAddColumn"
      >
        Add column
      </button>
    </nav>
    <nav class="">
&nbsp;
    </nav>

    <!-- Columns (columns) -->
    <div class="lists">
      <div v-for="column in columns" :key="column.id" class="list">
        <header class="">
          {{ column.name }}
          <button class="right btn btn-outline-danger btn-sm mt-1" @click="deleteCard(column.id)">
            Delete
          </button>
          <button class="right btn btn-outline-dark btn-sm mt-1 mx-1" @click="openAddCardForm(column.id)">
            Add
          </button>
        </header>
        <!--  -->
        <ul :id="column.id">
          <!-- AddCardForm -->
          <AddCardForm v-if="newCardForcolumn === column.id" :column-id="column.id"
                       @card-added="handleCardAdded" @card-canceled="closeAddCardForm"
          />
          <!-- ./AddCardForm -->

          <!-- Cards -->
          <draggable v-model="column.cards" class="" v-bind="cardDragOptions" @end="handleCardMoved">
            <transition-group class="" tag="div">
              <li v-for="card in column.cards" :key="card.id" class="list-item" @click="showEditCard(card)">
                {{ card.name }}
              </li>
              <!-- ./cards -->
            </transition-group>
          </draggable>
          <!-- No cards -->
          <li v-show="!column.cards.length && newCardForcolumn !== column.id" class="list-item">
            No cards yet
          </li>
          <!-- ./No cards -->
        </ul>
        <footer>&nbsp;</footer>
      </div>
    </div>

    <!-- column modal -->
    <modal name="addColumn">
      <div>
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="columnModalLabel" class="modal-title">
              Add new column
            </h5>
          </div>
          <div class="modal-body">
            <input v-model="columnName" class="form-control" type="text">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" @click="hideAddColumn">
              Close
            </button>
            <button type="button" class="btn btn-dark btn-sm" @click="addColumn">
              Save column
            </button>
          </div>
        </div>
      </div>
    </modal>

    <!-- edit card modal -->
    <modal name="editCard">
      <div class="modal-header">
        <h5 v-if="updateCardForm.name" id="editCardModalLabel" class="modal-title">
          Edit {{ updateCardForm.name }}
        </h5>
        <button type="button" class="btn-close" @click="hideEditCard" />
      </div>
      <div v-if="updateCardForm.cardId" class="modal-body">
        <input v-model="updateCardForm.name" class="form-control m-2" type="text">
        <input v-model="updateCardForm.description" class="form-control m-2" type="text">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="hideEditCard">
          Close
        </button>
        <button type="button" class="btn btn-dark" @click="editCard">
          Edit card
        </button>
      </div>
    </modal>
    <!-- ./Columns -->
  </div>
</template>

<script>
import draggable from 'vuedraggable'
import AddCardForm from './AddCardForm'
import axios from 'axios'

export default {
  components: { draggable, AddCardForm },
  data () {
    return {
      columns: [],

      newCardForcolumn: 0,
      columnName: null,
      updateCardForm: {
        name: null,
        description: null,
        cardId: null
      }
    }
  },
  computed: {
    cardDragOptions () {
      return {
        animation: 200,
        group: 'card-list',
        dragClass: 'column-drag'
      }
    }
  },
  mounted () {
    axios.get('/api/cards').then(response => (this.columns = response.data))
  },
  methods: {
    showEditCard (card) {
      this.updateCardForm.cardId = card.id
      this.updateCardForm.name = card.name
      this.updateCardForm.description = card.description
      this.$modal.show('editCard')
    },
    hideEditCard () {
      this.$modal.hide('editCard')
    },
    showAddColumn () {
      this.$modal.show('addColumn')
    },
    hideAddColumn () {
      this.$modal.hide('addColumn')
    },
    editCard () {
      axios.put('/api/cards', this.updateCardForm)
        .then(({ data }) => {
          const columnIndex = this.columns.findIndex(
            column => column.id === data.column_id
          )

          const cardIndex = this.columns[columnIndex].cards.findIndex(
            card => card.id === data.id
          )

          this.columns[columnIndex].cards[cardIndex] = data

          this.hideEditCard()
          this.$forceUpdate()
        })
    },
    addColumn () {
      axios.post('/api/columns', { name: this.columnName })
        .then(({ data }) => {
          this.hideAddColumn()
          this.columns.push(data)
        })
    },
    openAddCardForm (columnId) {
      this.newCardForcolumn = columnId
    },
    closeAddCardForm () {
      this.newCardForcolumn = 0
    },
    handleCardAdded (newCard) {
      const columnIndex = this.columns.findIndex(
        column => column.id === newCard.column_id
      )

      this.columns[columnIndex].cards.push(newCard)

      this.closeAddCardForm()
    },
    deleteCard (id) {
      axios.delete(`/api/columns/${id}`).then(() => {
        this.columns = this.columns.filter((column) => column.id !== id)
      })
    },
    handleCardMoved (evt) {
      axios.put('/api/cards/sync', { columns: this.columns }).catch(err => {
        console.log(err.response)
      })
    }
  }
}
</script>

<style>
body {
    margin: 0;
    font-family: 'Roboto';
    font-size: 14px;
    line-height: 1.3em;
}

.ui {
    height: 100vh;
    display: grid;
    grid-template-rows: 40px 50px 1fr;
    overflow-x: scroll;
}

.navbar.board {
    font-size: 1.1rem;
}

.lists {
    display: flex;
    overflow-x: auto;
}

.lists>* {
    flex: 0 0 auto;
    margin-left: 10px;
}

.lists::after {
    content: '';
    flex: 0 0 10px;
}

.list {
    width: 300px;
    height: calc(100% - 10px - 17px);
}

.right {
    float: right;
}

.list>* {
    background-color: #e2e4e6;
    color: #333;
    padding: 0 10px;
}

.list header {
    line-height: 36px;
    font-size: 16px;
    font-weight: bold;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.list footer {
    line-height: 36px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    color: #888;
}

.list ul {
    list-style: none;
    margin: 0;
    max-height: calc(100% - 36px - 36px);
    overflow-y: auto;
}

.list ul li {
    background-color: #fff;
    padding: 10px;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}

.list ul li:not(:last-child) {
    margin-bottom: 10px;
}

.list ul li img {
    display: block;
    width: calc(100% + 2 * 10px);
    margin: -10px 0 10px -10px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
</style>
