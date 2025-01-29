<script setup>
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';



const emits = defineEmits([
    'closeModal',
    'onClickMultipleTrash',
    'onClickMultipleAction',
    'onClickMultipleUnApprove',
    'onClickUntrash',
    'onClickMultipleApprove',
]);



const props = defineProps({
    translations: {
        type: Object,
    },
    isPopupMessageModalOpen: {
        type: Boolean,
    },
    modalInner: {
        type: Object,
    },
});


function closeModal() {
    emits('closeModal', false);
}


const onClickMoveToTrash = () => {
    emits('onClickMultipleTrash', props.modalInner.trashIds);
}

const onClickUntrash = () => {
    emits('onClickUntrash', props.modalInner.trashIds);
}

const onClickTakeAction = () => {
    emits('onClickMultipleAction', props.modalInner.trashIds);
}

const onClickUnApprove = () => {
    emits('onClickMultipleUnApprove', props.modalInner.trashIds);
}

const onClickApprove = () => {
    emits('onClickMultipleApprove', props.modalInner.trashIds);
}


</script>



<template>

<TransitionRoot appear :show="isPopupMessageModalOpen" as="template">
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
              class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
            >
              <DialogTitle
                as="h3"
                class="text-lg font-medium leading-6 text-gray-900"
              >
                {{ modalInner.modalHeading }}
              </DialogTitle>
              <div class="mt-2">
                <p class="text-sm text-gray-500">
                  {{ modalInner.modalDescription }}
                </p>
              </div>
              <div v-if="modalInner.showButtons" class="mt-2 flex flex-row justify-center items-center gap-1">
                <button v-if="!modalInner.trashPage && modalInner.approvePage" @click="onClickUnApprove" type="button" id="moveToTrash" class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                    UnApprove
                </button>
                <button v-if="!modalInner.trashPage && !modalInner.approvePage" @click="onClickApprove" type="button" id="moveToTrash" class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                    Approve
                </button>
                <!-- <button v-if="!modalInner.trashPage" @click="onClickTakeAction" type="button" class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                    TakeAction
                </button> -->
                <button v-if="!modalInner.trashPage" @click="onClickMoveToTrash" type="button" id="moveToTrash" class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                    MoveToTrash
                </button>
                <button v-if="modalInner.trashPage" @click="onClickUntrash" type="button" id="moveToTrash" class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                    Untrash
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
