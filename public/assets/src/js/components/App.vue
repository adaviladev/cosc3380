<template>
    <div id="app">
        {{message}}
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
      data() {
        return {
          message: 'hello'
        }
      }
    }
</script>

<style>

</style>