<template>
  <form
    class=""
    @submit.prevent="handleAddNewTask"
  >
    <div class="">
      <input
        v-model.trim="newCard.name"
        class="form-control"
        type="text"
        placeholder="Enter a name"
      >
      <textarea
        v-model.trim="newCard.description"
        class="form-control"
        rows="2"
        placeholder="Add a description (optional)"
      />
      <div v-show="errorMessage">
        <span class="text">
          {{ errorMessage }}
        </span>
      </div>
    </div>
    <div class="">
      <button
        type="reset"
        class="btn btn-secondary m-2"
        @click="$emit('card-canceled')"
      >
        cancel
      </button>
      <button
        type="submit"
        class="btn btn-dark m-2"
      >
        Add
      </button>
    </div>
  </form>
</template>

<script>
import axios from 'axios'
export default {
  props: {
    // eslint-disable-next-line vue/require-default-prop
    columnId: Number
  },
  data () {
    return {
      newCard: {
        name: '',
        description: '',
        columnId: null
      },
      errorMessage: ''
    }
  },
  mounted () {
    this.newCard.columnId = this.columnId
  },
  methods: {
    handleAddNewTask () {
      // Basic validation so we don't send an empty card to the server
      if (!this.newCard.name) {
        this.errorMessage = 'The name field is required'
        return
      }

      // Send new card to server
      axios
        .post('/api/cards', this.newCard)
        .then(res => {
          // Tell the parent component we've added a new card and include it
          this.$emit('card-added', res.data)
        })
        .catch(err => {
          // Handle the error returned from our request
          this.handleErrors(err)
        })
    },
    handleErrors (err) {
      if (err.response && err.response.columns === 422) {
        // We have a validation error
        const errorBag = err.response.data.errors
        if (errorBag.name) {
          this.errorMessage = errorBag.name[0]
        } else if (errorBag.description) {
          this.errorMessage = errorBag.description[0]
        } else {
          this.errorMessage = err.response.message
        }
      } else {
        // We have bigger problems
        console.log(err.response)
      }
    }
  }
}
</script>
