<script setup>
import { useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import { watch, ref } from 'vue'
import Dialog from './ui/dialog/Dialog.vue'
import DialogContent from './ui/dialog/DialogContent.vue'
import DialogHeader from './ui/dialog/DialogHeader.vue'
import DialogTitle from './ui/dialog/DialogTitle.vue'
import DialogFooter from './ui/dialog/DialogFooter.vue'
import DialogClose from './ui/dialog/DialogClose.vue'
import Label from './ui/label/Label.vue'
import Input from './ui/input/Input.vue'
import { Button } from './ui/button'

const props = defineProps({
  open: { type: Boolean, required: true },
  tenant: { type: Object, default: null }
})

const form = useForm({
  id: null,
  name: '',
  subdomain: '',
  photo: null,
  bg_color: '#06b6d4',
})

const photoPreview = ref(null)
const emit = defineEmits(['update:open', 'close'])

watch(() => props.tenant, (newTenant) => {
  if (newTenant) {
    form.id = newTenant.id
    form.name = newTenant.name
    form.subdomain = newTenant.tenant_domain?.replace(/\..+$/, '') || ''
    form.bg_color = newTenant.bg_color || '#06b6d4'
    form.photo = null
    photoPreview.value = newTenant.photo_url || null
  } else {
    form.reset()
    photoPreview.value = null
  }
}, { immediate: true })

watch(() => props.open, (isOpen) => {
  if (!isOpen && !props.tenant) {
    form.reset()
    photoPreview.value = null
  }
})

const handlePhotoChange = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.photo = file
    photoPreview.value = URL.createObjectURL(file)
  }
}

const submit = () => {
  const isEditing = !!props.tenant

  if (isEditing) {
    router.post(route('tenants.update', props.tenant.id), {
      _method: 'PUT',
      name: form.name,
      subdomain: form.subdomain,
      photo: form.photo,
      bg_color: form.bg_color,
    }, {
      forceFormData: true,
      onSuccess: () => {
        form.reset()
        photoPreview.value = null
        emit('update:open', false)
        emit('close')
        router.reload({ only: ['tenants'], preserveState: true })
      }
    })
  } else {
    form.post(route('tenants.store'), {
      forceFormData: true,
      onSuccess: () => {
        form.reset()
        photoPreview.value = null
        emit('update:open', false)
        emit('close')
        router.reload({ only: ['tenants'], preserveState: true })
      },
      preserveScroll: true,
    })
  }
}
</script>

<template>
  <Dialog :open="props.open" @update:open="emit('update:open', $event)">
    <DialogContent class="sm:max-w-[625px]">
      <form @submit.prevent="submit">
        <DialogHeader>
          <DialogTitle>{{ props.tenant ? 'Editar Tenant' : 'Novo Tenant' }}</DialogTitle>
        </DialogHeader>

        <div class="grid gap-4 py-4">
          <div class="grid gap-3">
            <Label for="name">Nome</Label>
            <Input id="name" name="name"
            v-model="form.name" />
          </div>
        </div>

        <div class="grid gap-4 py-4">
          <div class="grid gap-3">
            <Label for="subdomain">SubDomínio</Label>
            <Input id="subdomain" name="subdomain"
            v-model="form.subdomain" />
          </div>
        </div>

        <div class="grid gap-4 py-4">
          <div class="grid gap-3">
            <Label for="photo">Logo / Foto</Label>
            <input
              id="photo"
              type="file"
              accept="image/jpg,image/jpeg,image/png,image/webp"
              @change="handlePhotoChange"
              class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm file:border-0 file:bg-transparent file:text-sm file:font-medium"
            />
            <img
              v-if="photoPreview"
              :src="photoPreview"
              alt="Preview"
              class="mt-2 w-32 h-32 object-contain rounded border"
            />
            <span v-if="form.errors.photo" class="text-sm text-red-600">
              {{ form.errors.photo }}
            </span>
          </div>
        </div>

        <div class="grid gap-4 py-4">
          <div class="grid gap-3">
            <Label for="bg_color">Cor de Fundo do Formulário</Label>
            <div class="flex items-center gap-3">
              <input
                id="bg_color"
                type="color"
                v-model="form.bg_color"
                class="w-12 h-10 rounded border border-input cursor-pointer"
              />
              <Input
                v-model="form.bg_color"
                placeholder="#06b6d4"
                class="flex-1"
              />
            </div>
            <span v-if="form.errors.bg_color" class="text-sm text-red-600">
              {{ form.errors.bg_color }}
            </span>
          </div>
        </div>

        <DialogFooter>
          <DialogClose as-child>
            <Button variant="outline" :disabled="form.processing">Cancelar</Button>
          </DialogClose>

          <Button variant="primary" type="submit" :disabled="form.processing">
            <span v-if="form.processing" class="flex items-center gap-2">
              <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              Salvando...
            </span>
            <span v-else>Salvar</span>
          </Button>
        </DialogFooter>
      </form>
    </DialogContent>
  </Dialog>
</template>
