<script setup lang="ts">
import { RouterView } from 'vue-router'
import TopNav from './components/TopNav.vue';
import { ref, onMounted, onUnmounted } from 'vue';
import PubSub from 'pubsub-js'
import PubSubEvents from './PubSubEvents';
import author from './utils/auth';
import VerifyToken from './apis/VerifyToken';
import AuthorView from './views/AuthorView.vue';

const authed = ref<boolean>(author.isAuthed())
var subToken: PubSubJS.Token|null = null
onMounted(() => {
  subToken = PubSub.subscribe(PubSubEvents.AUTH_TOKEN_CHANGED, () => {
    authed.value = author.isAuthed()
  });
  if (authed.value) {
    (new VerifyToken()).call()
  }
})
onUnmounted(() => {
  if (subToken !== null) {
    PubSub.unsubscribe(subToken)
    subToken = null
  }
})
</script>

<template>
  <template v-if="authed">
    <TopNav />

    <RouterView />
  </template>
  <AuthorView v-else />
</template>
