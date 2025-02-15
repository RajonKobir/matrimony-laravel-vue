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
import TakeAction from './TakeAction.vue';
import Biodata from './Biodata/Biodata.vue';


const emits = defineEmits([
    'closeModal',
    'onClickPermanentDelete',
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
const showTakeAction = ref(false);
const showEdit = ref(false);


function closeModal() {
    showEdit.value = false;
    showAllData.value = false;
    showTakeAction.value = false;
    emits('closeModal', false);
}


const onClickPermanentDelete = (single_biodata) => {
    emits('onClickPermanentDelete', single_biodata);
}


watch(props, async (newValue, oldValue) => {
    if( page.props.flash.success == null && page.props.flash.error == null ){
        showAllData.value = newValue.modalInner.showAllData;
        showTakeAction.value = newValue.modalInner.showTakeAction;
    }
});


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

                <div v-if="showEdit" class="mt-8">
                    <Biodata :translations="front_end_translations" :locale :locales :districts :user_id="modalInner.viewBiodata.user_id" />
                </div>

                <div class="mt-8 text-center">
                    <button type="button" @click="showEdit = !showEdit" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-2 px-4 rounded-full">
                        {{ showEdit ? 'Hide Edit' : 'Edit Biodata' }}
                    </button>
                </div>

                <div v-if="showAllData" class="mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                        <div v-for="single_entity in Object.keys(modalInner.viewBiodata)" :key="single_entity.id" class="">
                            <p class="text-sm text-gray-500">
                                <span class="font-bold">{{ single_entity }} : </span>
                                {{ modalInner.viewBiodata[single_entity] }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <button type="button" @click="showAllData = !showAllData" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-2 px-4 rounded-full">
                        {{ showAllData ? 'HideAllData' : 'showAllData' }}
                    </button>
                </div>

                <div v-if="showTakeAction" class="mt-8">
                    <TakeAction :translations :modalInner />
                </div>

                <div class="mt-8 text-center">
                    <button type="button" @click="showTakeAction = !showTakeAction" class="action_button text-xs bg-blue-500 hover:bg-blue-700 !text-white font-bold py-2 px-4 rounded-full">
                        {{ showTakeAction ? 'HideTakeAction' : 'TakeAction' }}
                    </button>
                </div>

                <div v-if="modalInner.trashPage" class="mt-8 text-center">
                    <button type="button" @click="onClickPermanentDelete(modalInner.viewBiodata)" class="text-xs bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                        Delete Permanently
                    </button>
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
