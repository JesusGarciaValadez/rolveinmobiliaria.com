<template>
  <div :class="['alert alert-', this.type ]" v-if="this.message">
    {{ this.message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</template>

<script>
  export default {
    name: "Alert",
    props: {
      type: {
        type: String,
        default: '',
        required: true,
      },
      message: {
        type: String,
        default: '',
        required: true,
      }
    }
  }
</script>

<style scoped>

</style>
