<script setup>
import { ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';
import TermsForm from './TermsForm.vue';
import TermsView from './TermsView.vue';


const emits = defineEmits([
    'closeModal',
    'onAddedSingleTerm',
]);


const props = defineProps({
    translations: {
        type: Object,
    },
    front_end_translations: {
        type: Object,
    },
    districts: {
        type: Object,
    },
    locale: {
        type: String,
    },
    locales: {
        type: Array,
    },
    isPopupViewModalOpen: {
        type: Boolean,
    },
    modalInner: {
        type: Object,
    },
});


// initializing
const page = usePage();
const showAllData = ref(false);
const showEdit = ref(false);


function closeModal() {
    showEdit.value = false;
    showAllData.value = false;
    emits('closeModal', false);
}


const onAddedSingleTerm = (term) => {
    emits('onAddedSingleTerm', term);
}


</script>



<template>


<TransitionRoot appear :show="isPopupViewModalOpen" as="template">
    <Dialog as="div" @close="closeModal" class="relative z-10">
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-black/25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div
          class="flex min-h-full items-center justify-center p-4 text-center"
        >
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <DialogPanel
              class="mt-20 w-full max-w-7xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
            >
                <DialogTitle
                    as="h3"
                    class="text-lg font-medium leading-6 text-gray-900 xl:text-center"
                >
                    {{ modalInner.modalHeading }}
                    <div class="absolute right-4 top-4">
                        <button
                        type="button"
                        class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                        @click="closeModal"
                        >
                            Close
                        </button>
                    </div>
                </DialogTitle>

                <div v-if="modalInner.addNew || modalInner.onEdit" class="mt-12 text-center">
                    <h1 class="text-center">
                        Add New Term
                    </h1>
                    <TermsForm :translations :single_term="modalInner.single_term" :on_edit="modalInner.onEdit" @onAddedSingleTerm="onAddedSingleTerm"/>
                </div>

                <div v-if="modalInner.onView" class="mt-12 text-center">
                    <h1 class="text-center mt-12">
                        Details of the term id: {{ modalInner.single_term.id }}
                    </h1>
                    <TermsView :translations :single_term="modalInner.single_term" />
                </div>

              <div class="mt-4">
                <button
                  type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="closeModal"
                >
                    Close
                </button>

              </div>

            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>

</template>
