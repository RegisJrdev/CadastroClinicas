<script setup>
import { Head } from "@inertiajs/vue3";
import SubmissionsTable from "@/Components/TableSubmissions.vue";

const props = defineProps({
  submissions: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <Head title="Submissões do Formulário" />

  <div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">
          Submissões do Formulário
        </h1>
        <p class="text-gray-600 mt-2">
          Visualize todas as respostas enviadas pelos usuários
        </p>
      </div>

      <div class="bg-white rounded-lg shadow">
        <SubmissionsTable :submissions="submissions" />
      </div>
    </div>
  </div>
</template>