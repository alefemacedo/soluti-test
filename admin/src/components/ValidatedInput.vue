<template>
  <div class="form-group">
    <label :for="id">{{ label }}</label>
    <b-form-input
      v-model="input"
      :type="type"
      class="form-control"
      :class="{ 'is-invalid':  hasError(id) }"
      :id="id"
      :placeholder="placeholder"/>
    <div v-for="(message, index) in getErrorMessages(id)" :key="index" class="invalid-feedback">
      {{ message }}
    </div>
  </div>
</template>

<script>
export default {
  props: {
    value: {
      required: true
    },
    id: {
      type: String,
      required: true,
      default: ""
    },
    placeholder: {
      type: String,
      default: ""
    },
    label: {
      type: String,
      required: true,
      default: ""
    },
    type:{
      type: String,
      default: "text"
    },
    messages: {
      type: Object,
      required: true,
      default() {
        return {}
      }
    }
  },
  data() {
    return {
    }
  },
  computed: {
    input: {
      get() {
        return this.value
      },
      set(value) {
        this.$emit("input", value)
      }
    }
  },
  methods: {
    hasError(property) {
      return Object.prototype.hasOwnProperty.call(this.messages, property)
    },
    getErrorMessages(property) {
      return this.messages[property]
    }
  }
}
</script>

<style>

</style>