<script setup>
import Modal from '@/Components/Modal.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  show: Boolean,
  user: Object,
})

const emit = defineEmits(['close'])

const form = useForm({})

const confirmDelete = () => {
  form.delete(route('usuarios.deleteUser', props.user.id), {
    onSuccess: () => {
      emit('close')
    }
  })
}
</script>

<template>
  <Modal :show="show" @close="emit('close')">
    <div class="p-6">
      <h2 class="text-lg font-semibold text-gray-900 mb-4">
        ¿Estás seguro de que deseas eliminar este usuario?
      </h2>
      <p class="mb-4 text-sm text-gray-600">
        Esta acción no se puede deshacer.
      </p>

      <div class="flex justify-end space-x-4">
        <button @click="emit('close')" class=" bg-blue-600 text-white hover:text-blue-700 px-4 py-2 rounded">
          Cancelar
        </button>
        <button @click="confirmDelete" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
          Eliminar
        </button>
      </div>
    </div>
  </Modal>
</template>
