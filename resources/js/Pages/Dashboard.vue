<script setup>
import CardTenants from "@/Components/CardTenants.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const open = ref(false);

const props = defineProps({
  tenants: {
    type: Object,
  },
});


</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 uppercase">
        Cadastro de Tenants
      </h2>
    </template>

    <div class="">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-end">
          <Button
            class="mb-4 bg-cyan-400 hover:bg-cyan-500 text-white shadow font-bold"
            @click="open = true"
          >
            Cadastrar Novo Tenant
          </Button>
        </div>

        <NewEditQuestionDialog v-model:open="open" />

        <div class="border rounded-md max-h-[800px] overflow-auto">
          <TableTenants class="bg-white" :tenants="props.tenants.data" />
        </div>

        <!-- <Card>
          <CardHeader>
            <CardTitle>Card Title</CardTitle>
            <CardDescription>Card Description</CardDescription>
          </CardHeader>
          <CardContent>
            <p>Card Content</p>
          </CardContent>
          <CardFooter>
            <p>Card Footer</p>
          </CardFooter>
        </Card> -->
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
