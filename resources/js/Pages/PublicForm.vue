<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { toast } from "vue-sonner";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  questions: {
    type: Array,
    default: () => [],
  },
  tenantId: {
    type: [Number, String],
    required: true,
  },
});


const form = useForm({
  tenant_id: props.tenantId,
  answers: {},
})


const submit = () => {
  form.post(route("public_form.store"), {
    onSuccess: () => {
      form.reset();
      toast.success("Pergunta criada com sucesso!");
      router.reload({ only: ["tenants"] });
    },
    onError: () => {
      toast.error("Erro ao criar pergunta!");
    },
  })
};
</script>

<template>
  <Head title="Formulário" />

   <a
    :href="route('form_submissions.index')"
    class="fixed top-4 right-4 z-50 flex items-center gap-2 rounded-xl
           bg-white text-black px-4 py-2 text-sm font-semibold
           shadow-lg hover:bg-gray-200 transition"
  >
    Admin
  </a>

  <div class="min-h-screen grid grid-cols-1 md:grid-cols-2">
    
    <!-- Esquerdo -->
    <div class="flex items-center justify-center p-24">
      <img
        src="/images/bg-logo.jpg"
        alt="Imagem do formulário"
        class="w-full h-full object-contain"
      />
    </div>

    <!-- Direito -->
    <div class="flex items-center justify-center p-6 bg-gradient-to-t from-cyan-500 to-cyan-600">
      <form
        @submit.prevent="submit"
        class="w-full max-w-xl bg-white rounded-2xl border shadow-xl p-6"
      >
        <h2 class="text-3xl font-semibold mb-5 text-center">
          Cadastro
        </h2>

        <div class="grid gap-3 py-4">
          <Label class="mb-4">
            Preencha os dados abaixo para se cadastrar no clube de benefícios e telemedicina.
          </Label>

          <div class="space-y-4">
            <div
              v-for="question in questions"
              :key="question.id"
              class="space-y-1"
            >
              <Label
                :for="`question-${question.id}`"
                class="block text-sm font-normal"
              >
                {{ question.title }}
              </Label>

              <Input
                :id="`question-${question.id}`"
                :type="question.type"
                v-model="form.answers[question.id]"
                class="accent-cyan-500"
              />
            </div>
          </div>

          <pre>{{ form.questions }}</pre>
        </div>

        <button
          type="submit"
          class="w-full mt-6 rounded-xl bg-gradient-to-r
                 from-cyan-500 to-cyan-600
                 text-white py-2.5 font-semibold
                 hover:opacity-90 transition"
        >
          Enviar
        </button>
      </form>
    </div>
  </div>
</template>
