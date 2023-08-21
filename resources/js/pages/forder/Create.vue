<template>
    <div class="p-3">
        <div class="mb-6">
            <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Forder Name
            </label>
            <input v-model="formData.name" type="text"
                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <button @click="createFolder" type="button"
                class="text-white mt-2 w-full bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Create</button>
        </div>
    </div>
</template>
<script>
import Swal from 'sweetalert2'
export default {
    data() {
        return {
            formData: {
                name: ""
            }
        }
    },
    methods: {
        //function to create folder and save them to database
        async createFolder() {
            try {
                const { data } = await axios.post('/api/forder/create', this.formData);
                if (data) {
                    this.$router.push({ name: 'Home' });
                }
            } catch (error) {
                console.log(error);
                Swal.fire(error?.response?.data?.message);
            }
        }
    },
}
</script>