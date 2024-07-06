<template>
  <Head title="Welcome"/>

  <div
      class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <div>
      <div class="mb-6">
        <select class="bg-transparent border w-full rounded text-white text-xl text-center appearance-none"
                @change="changeCompany">
          <option v-for="company in companies" :selected="currentCompany.index === company.index"
                  :value="company.index">{{ company.name }}
          </option>
        </select>
      </div>
      <div class="mb-6">
        <VueDatePicker :model-value="currentDate" :disabled-week-days="[6, 0]" @date-update="changeDate"  class="rounded-xl" :format="'dd.MM.Y'"></VueDatePicker>
      </div>

      <div class="bg-white p-4 rounded-lg" :class="loading ? 'animate-pulse !bg-gray-500' : ''">
        <div class="flex">
          <p class="w-1/2 flex justify-between items-center">
            <span class="text-xs pr-2">Open</span>
            <span class="pr-2 font-black">${{ stock.open ?? '--' }}</span>
          </p>
          <p class="w-1/2 flex justify-between items-center">
            <span class="text-xs pr-2">Close</span>
            <span class="pr-2 font-black">${{ stock.close ?? '--' }}</span>
          </p>
        </div>
        <div class="flex">
          <p class="w-1/2 flex justify-between items-center">
            <span class="text-xs pr-2">High</span>
            <span class="pr-2 font-black">${{ stock.high ?? '--' }}</span>
          </p>
          <p class="w-1/2 flex justify-between items-center">
            <span class="text-xs pr-2">Low</span>
            <span class="pr-2 font-black">${{ stock.low ?? '--' }}</span>
          </p>
        </div>
        <div class="flex justify-center items-center">
          <span class="text-xs pr-2">volume</span> <span class="font-black">${{ stock.volume ?? '--' }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {Head} from '@inertiajs/vue3';
import {router} from '@inertiajs/vue3'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {

  data() {
    return {
      loading: false,
      currentDate: new Date(),
    }
  },

  components: {
    Head,
    VueDatePicker,
  },

  props: {
    stock: {
      type: Object,
      default: () => {
        return {
          open: 0,
          close: 0,
          high: 0,
          low: 0,
        }
      }
    },
    companies: Array,
    currentCompany: Object,
    date: String,
  },

  mounted() {
    this.currentDate = new Date(this.date);
  },

  methods: {
    changeCompany(event) {
      this.loading = true;
      router.visit('/' + event.target.value + '/' + this.currentDate.toISOString().split('T')[0],{},{
        onSuccess: () => {
          this.loading = false;
        },
      });
    },
    changeDate(date){
      date = new Date(date).toISOString().split('T')[0];
      this.loading = true;
      router.visit('/' + this.currentCompany.index + '/' + date,{},{
        onSuccess: () => {
          this.loading = false;
        },
      });
    }
  },
}

</script>

<style>
.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}
</style>
