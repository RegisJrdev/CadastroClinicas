<script setup>
import CardTenants from "@/Components/CardTenants.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const open = ref(false);
const openModalQuestions = ref(false);
const tenantId = ref(null);

const props = defineProps({
  tenants: {
    type: Object,
  },
  questions: {
    type: Object,
  },
});

const openAssignQuestionsModal = (tenant_id) => {
  tenantId.value = tenant_id;
  openModalQuestions.value = true;
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 uppercase">Tenants</h2>
    </template>

    <div class="">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-end">
          <Button
            class="flex items-center gap-2 mb-4 rounded-xl bg-cyan-500 hover:bg-cyan-600 px-5 py-2.5 text-white font-semibold shadow-md transition-colors duration-300 ease-in-out"
            @click="open = true"
          >
            Cadastrar Novo Tenant
          </Button>
        </div>

        <NewEditQuestionDialog v-model:open="open" />

        <div class="border rounded-xl border-gray-200 max-h-[800px] overflow-auto">
          <TableTenants
            @request-assign-questions="openAssignQuestionsModal"
            class="bg-white"
            :tenants="props.tenants.data"
          />
        </div>

        <LinkTenantQuestionsDialog
          :tenantId="tenantId"
          :open-modal-questions="openModalQuestions"
          @close="openModalQuestions = false"
          :questions="props.questions"
        />

        <!-- <CardTenants :tenants="props.tenants.data"/>  -->

        <!-- <div v-if="props.tenants && props.tenants.data.length">
          <div
            v-for="tenant in props.tenants.data"
            :key="tenant.id"
            class="overflow-hidden bg-white shadow-sm sm:rounded-lg mb-4"
          >
            <div class="p-6 text-gray-900">
              {{ tenant.name }} — {{ tenant.subdomain }}
            </div>
          </div>
        </div> -->

        <!-- <div v-else class="text-gray-500 text-center py-6">Nenhum tenant cadastrado</div> -->
      </div>
    </div>
  </AuthenticatedLayout>
</template>
