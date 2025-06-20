<script setup>
import Modal from '@/Components/Modal.vue'
import { useForm } from '@inertiajs/vue3'
import { watch, computed } from 'vue'

const props = defineProps({
  show: Boolean,
  user: Object,
  roles: Array
})

const emit = defineEmits(['close'])

const form = useForm({
  name: '',
  lastName: '',
  email: '',
  phoneNumber: '',
  password: '',
   role_id: ''
})

watch(
  () => props.user,
  (user) => {
    if (user) {
      form.name = user.name
      form.lastName = user.lastName
      form.email = user.email
      form.phoneNumber = user.phoneNumber
    }
  },
  { immediate: true }
)

const submit = () => {
  form.put(route('usuarios.updateUser', props.user.id), {
    onSuccess: () => {
      emit('close')
      form.reset()
    }
  })
}
</script>

<template>
  <Modal :show="show" @close="emit('close')">
    <div class="p-6">
      <h2 class="text-lg font-semibold text-gray-900 mb-4">Editar Usuario</h2>

      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Nombre</label>
          <input v-model="form.name" type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Apellido</label>
          <input v-model="form.lastName" type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Rol</label>
          <select v-model="form.role_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            <option v-for="role in roles" :key="role.id" :value="role.id">
              {{ role.name }}
            </option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Correo</label>
          <input v-model="form.email" type="email" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Teléfono</label>
          <input v-model="form.phoneNumber" type="text" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
          <input v-model="form.password" type="password" class="mt-1 block w-full rounded border-gray-300 shadow-sm" />
        </div>

        <div class="flex justify-end mt-6 space-x-4">
          <button type="button" @click="emit('close')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Cancelar</button>
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Guardar</button>
        </div>
      </form>
    </div>
  </Modal>
</template>
