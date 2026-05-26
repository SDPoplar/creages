<script setup lang="ts">
import Login from '@/apis/Login';
import author from '@/utils/auth';
import { ref } from 'vue';

const LAST_ACCOUNT_STORAGE = 'last_auth_account'
const account = ref<string>(localStorage.getItem(LAST_ACCOUNT_STORAGE) ?? '')
const pwd = ref<string>('')
function canSubmit(): boolean {
  return account.value.length > 0 && pwd.value.length > 0
}
function login() {
  (new Login(account.value, pwd.value)).call().then(resp => {
    localStorage.setItem(LAST_ACCOUNT_STORAGE, account.value)
    author.setToken(resp?.data.token)
  }).catch(reason => {
    console.log(reason)
  })
}
</script>

<template>
  <div class="card auth-card">
    <div class="card-body">
      <form>
        <label for="inAccount">Account</label>
        <input type="text" id="inAccount" class="form-control" v-model="account" />
        <label for="inPwd" class="mt-3">Password</label>
        <input type="password" id="inPwd" class="form-control" v-model="pwd" />
        <button type="button" class="btn btn-primary mt-3 mx-auto w-50" :disabled="!canSubmit()" @click="login">Login</button>
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