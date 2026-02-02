<script setup>
import { Settings } from "lucide-vue-next";

const props = defineProps({
  tenants: {
    type: Array,
    required: true,
    default: () => [],
  },
});

const emit = defineEmits(["request-assign-questions"]);

const linkTenantQuestions = (id) => {
  emit("request-assign-questions", id);
}
</script>

<template>
  <Table>
    <TableHeader>
      <TableRow>
        <TableHead class="w-[100px] text-center"> Nome </TableHead>
        <TableHead class="text-center">SubDomínio</TableHead>
        <TableHead class="text-center"> Teste </TableHead>
        <TableHead class="text-center"> Ações </TableHead>
      </TableRow>
    </TableHeader>
    <TableBody>
      <TableRow v-for="tenant in tenants" :key="tenant.name">
        <TableCell class="font-medium text-center">
          {{ tenant.name }}
        </TableCell>
        <TableCell class="text-center"
          ><a href="#" target="blank">{{ tenant.tenant_domain }}</a></TableCell
        >
        <TableCell class="text-center"> teste </TableCell>
        <TableCell class="text-center">
          <button @click="linkTenantQuestions(tenant.id)" class="inline-flex items-center gap-2 rounded-md">
            <Settings class="w-5 h-5" />
          </button>
        </TableCell>
      </TableRow>
    </TableBody>
    
  </Table>
</template>
