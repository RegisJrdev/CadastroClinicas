<script setup>
import { Settings } from "lucide-vue-next";

const props = defineProps({
  tenants: {
    type: Array,
    required: true,
    default: () => [],
  },
});
</script>

<template>
  <Table>
    <TableHeader>
      <TableRow>
        <TableHead class="w-[100px] text-center"> Invoice </TableHead>
        <TableHead class="text-center">Status</TableHead>
        <TableHead class="text-center"> Amount </TableHead>
        <TableHead class="text-center"> Amount </TableHead>
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
          <button @click="open" class="inline-flex items-center gap-2 rounded-md">
            <Settings class="w-5 h-5" />
          </button>
        </TableCell>
      </TableRow>
    </TableBody>
    
  </Table>
</template>
