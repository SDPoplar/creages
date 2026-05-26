<script setup lang="ts">
import { Project } from '@/instances/project';
import { ref, onMounted } from 'vue';

const pl = ref<Project[]>([])
onMounted(() => {

})
</script>
<template>
  <div class="rol proj-grid">
    <div class="col-md-4 col-lg-2 col-sm-6" v-for="value in pl"></div>
  </div>
</template>

<style scoped>
.proj-grid {
  background-color: #EFEFEF;
  min-height: 30vh;
}
</style>