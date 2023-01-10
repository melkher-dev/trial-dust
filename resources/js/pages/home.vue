<template>
  <div>
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
  }
}
</script>
