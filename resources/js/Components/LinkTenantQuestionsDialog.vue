<script setup>
import { useForm } from "@inertiajs/vue3";
import { toast } from "vue-sonner";
import { router } from "@inertiajs/vue3";
import { CheckCheck } from "lucide-vue-next";
import DialogContent from "./ui/dialog/DialogContent.vue";
import { ref } from "vue";

const selectedQuestions = ref([]);

const props = defineProps({
  openModalQuestions: { type: Boolean, required: true },
  questions: { type: Array, required: true },
  tenantId: { type: Number, required: true },
});

const form = useForm({
  tenant_id: props.tenantId,
  questions: selectedQuestions,
});

const emit = defineEmits(["close"]);
const toggleQuestion = (id) => {
  const index = selectedQuestions.value.indexOf(id);

  if (index === -1) {
    selectedQuestions.value.push(id);
  } else {
    selectedQuestions.value.splice(index, 1);
  }
};


const submit = () => {
  form.tenant_id = props.tenantId;
  form.questions = selectedQuestions.value;
  form.post(route("tenant_questions.store"), {
    onSuccess: () => {
      form.reset();
      selectedQuestions.value = [];
      emit("close");
      toast.success("Pergunta criada com sucesso!");
      router.reload({ only: ["tenants"] });
    },
    onError: () => {
      toast.error("Erro ao criar pergunta!");
    },
  });
};
</script>

<template>
  <Dialog :open="props.openModalQuestions">
    <DialogContent class="sm:max-w-[625px]">
      <form @submit.prevent="submit">
        <DialogHeader>
          <DialogTitle>Associar Questões</DialogTitle>
        </DialogHeader>

        <div class="grid gap-4 py-4">
          <div
            v-for="question in questions"
            :key="question.id"
            @click="toggleQuestion(question.id)"
            class="flex flex-row gap-4 border p-3 rounded cursor-pointer hover:bg-slate-50"
            :class="{
              'border-blue-500 bg-blue-50': selectedQuestions.includes(question.id),
            }"
          >
            <Checkbox :checked="selectedQuestions.includes(question.id)" />
            <Label class="cursor-pointer">{{ question.title }}</Label>
          </div>
        </div>

        <DialogFooter>
          <PrimaryButton type="button" class="bg-red-500" @click="emit('close')">
            Cancelar
          </PrimaryButton>

          <PrimaryButton type="submit" class="bg-gradient-to-r from-cyan-500 to-cyan-600"> Salvar </PrimaryButton>
        </DialogFooter>
      </form>
    </DialogContent>
  </Dialog>
</template>
