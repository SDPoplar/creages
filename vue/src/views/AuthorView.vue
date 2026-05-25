<script setup lang="ts">
import { ref } from 'vue';

const account = ref<string>('')
const pwd = ref<string>('')
</script>

<template>
  <div class="card auth-card">
    <div class="card-body">
      <form>
        <label for="inAccount">Account</label>
        <input type="text" id="inAccount" class="form-control" v-model="account" />
        <label for="inPwd" class="mt-3">Password</label>
        <input type="password" id="inPwd" class="form-control" v-model="pwd" />
        <button class="btn btn-primary mt-3 mx-auto w-50" :disabled="account.length <= 0 || pwd.length <= 0">Login</button>
      </form>
    </div>
  </div>
</template>

<style lang="css" scoped>
.auth-card {
  max-width: 40vw;
  margin: auto;
  margin-top: 24vh;
}
</style>