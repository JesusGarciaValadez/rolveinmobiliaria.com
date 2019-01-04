<template>
  <div class="row">
    <p class="col-sm-12 text-center">
      <strong class="text-danger">{{ this.message }}</strong>
      <strong>
        Selecciona otro o
        <a
          href="#"
          title="crea uno nuevo"
          target="_self"
          data-toggle="modal"
          data-target="#newClient">crea uno nuevo</a>
      </strong>
    </p>
  </div>
</template>

<script>
  export default {
    name: "CreateNewClientLink",
    props: {
      message: {
        type: String,
        required: true,
        default: '¿No existe el cliente?'
      }
    }
  }
</script>

<style scoped>

</style>
