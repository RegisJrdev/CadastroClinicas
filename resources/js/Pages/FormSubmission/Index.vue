<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import SubmissionsTable from "@/Components/TableSubmissions.vue";
import { Button } from "@/Components/ui/button";

const props = defineProps({
  submissions: {
    type: Object,
    required: true,
  },
});

const form = useForm({});

const logout = () => {
  form.post(route('tenant.logout'));
};
</script>

<template>
  <Head title="Submissões do Formulário" />

  <div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
      <div class="mb-6 flex justify-between items-center">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">
            Submissões do Formulário
          </h1>
          <p class="text-gray-600 mt-2">
            Visualize todas as respostas enviadas pelos usuários
          </p>
        </div>
        <div class="flex gap-3">
          <Button
            as-child
            variant="secondary"
          >
            <Link :href="route('public_form.show')">
              Formulário
            </Link>
          </Button>
          <Button
            @click="logout"
            variant="danger"
          >
            Sair
          </Button>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow">
        <SubmissionsTable :submissions="submissions" />
      </div>
    </div>
  </div>
</template>