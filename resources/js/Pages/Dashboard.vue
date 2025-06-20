<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import UserModal from '@/Pages/User/UserModal.vue'
import UserUpdate from '@/Pages/User/UserUpdate.vue'
import ConfirmDeleteModal from '@/Components/ConfirmDeleteModal.vue'
import { Head } from '@inertiajs/vue3'
import { ref, computed, watch } from 'vue'
import { usePage } from '@inertiajs/vue3'
import pagination from '@/Components/pagination.vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  users: Object,
  search: String,
  roles: Array,
  isAdmin: Boolean,
})

const page = usePage()
const successMessage = computed(() => page.props.flash?.success)
const showCreateModal = ref(false)
const showEditModal = ref(false)
const selectedUser = ref(null)
const showDeleteModal = ref(false)
const userToDelete = ref(null)

const openEditModal = (user) => {
  selectedUser.value = user
  showEditModal.value = true
}

const openDeleteModal = (user) => {
  userToDelete.value = user
  showDeleteModal.value = true
}

const exportarUsuarios = () => {
  window.open(route('usuarios.export'), '_blank')
}

const searchQuery = ref(props.search || '')

const buscarUsuarios = () => {
  router.get(route('dashboard'), { search: searchQuery.value }, { preserveState: true })
}

</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Gestión de Usuarios
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div v-if="successMessage" class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-300">
              {{ successMessage }}
            </div>
            <div class="flex justify-between items-center mb-4">
              <h1 class="text-2xl font-bold">Usuarios</h1>
              <div class="space-x-2">
                <button @click="showCreateModal = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" v-if="isAdmin">
                  <i class="fa-solid fa-user-plus"></i>
                </button>
                <button  @click="exportarUsuarios" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                  <i class="fa-solid fa-file-arrow-down"></i>
                </button>
              </div>
            </div>
            <div class="flex items-center space-x-2 w-full">
              <input
                v-model="searchQuery"
                @keyup.enter="buscarUsuarios"
                type="text"
                placeholder="Buscar usuario..."
                class="border border-gray-300 px-3 py-2 rounded w-full"
              />
              <button @click="buscarUsuarios" class="bg-blue-600 text-white px-3 py-2 mb-3 rounded hover:bg-blue-700">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
            <UserModal :show="showCreateModal" :roles="roles" @close="showCreateModal = false" />

            <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg overflow-hidden">
              <thead class="bg-gray-100">
                <tr>
                  <th class="text-left px-4 py-2">Nombre</th>
                  <th class="text-left px-4 py-2">Apellido</th>
                  <th class="text-left px-4 py-2">Email</th>
                  <th class="text-left px-4 py-2">Teléfono</th>
                  <th class="text-left px-4 py-2">Rol</th>
                  <th class="text-center px-4 py-2" v-if="isAdmin">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="user in users.data"
                  :key="user.id"
                  class="border-t hover:bg-gray-50"
                >
                  <td class="px-4 py-2">{{ user.name }}</td>
                  <td class="px-4 py-2">{{ user.lastName }}</td>
                  <td class="px-4 py-2">{{ user.email }}</td>
                  <td class="px-4 py-2">{{ user.phoneNumber }}</td>
                  <td class="px-4 py-2">{{ user.role.name }}</td>
                  <td class="px-4 py-2 text-center space-x-2" v-if="isAdmin">
                    <button @click="openEditModal(user)" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button @click="openDeleteModal(user)" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </td>
                </tr>
                <tr v-if="users.data.length === 0">
                  <td colspan="5" class="text-center py-4 text-gray-500">
                    No se encontraron usuarios.
                  </td>
                </tr>
              </tbody>
            </table>
            <pagination :links="users.links" />
          </div>
        </div>
      </div>
    </div>

    <UserUpdate :show="showEditModal" :user="selectedUser" :roles="roles" @close="showEditModal = false"/>
    <ConfirmDeleteModal :show="showDeleteModal" :user="userToDelete" @close="showDeleteModal = false"/>
  </AuthenticatedLayout>
</template>
