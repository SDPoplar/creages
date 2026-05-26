<script setup lang="ts">
import ProjectGrid from '@/components/ProjectGrid.vue';
import { faArrowsRotate, faPlus } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

</script>

<template>
  <div class="container mt-3">
    <div class="row">
      <div class="col-8">
        <h3 class="part-title">
          Projects
          <div class="btn-group btn-group-sm float-end">
            <button type="button" class="btn btn-secondary"><FontAwesomeIcon :icon="faArrowsRotate" /></button>
            <button type="button" class="btn btn-secondary"><FontAwesomeIcon :icon="faPlus" /></button>
          </div>
        </h3>
        <ProjectGrid />
      </div>
      <div class="col-4"></div>
    </div>
  </div>
</template>

<style scoped>
.part-title {
  border-bottom: 1px solid #333;
}
</style>
