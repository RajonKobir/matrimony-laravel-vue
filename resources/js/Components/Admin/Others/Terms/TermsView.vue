<script setup>


const props = defineProps({
    translations: {
        type: Object,
    },
    single_term: {
        type: Object,
    },
});


</script>


<template>



    <div class="biodata_main w-full min-h-screen">

        <div class="main-container">

            <div class="grid grid-cols-12 gap-0">

                <div class="form_item col-span-12 p-2">
                    <p class="text-base text-center">
                        <span class="text-lg text-center font-bold">
                            Serial No:
                        </span>
                        <span class="text-base text-center pl-2">
                            {{ single_term.serial_no }}
                        </span>
                    </p>
                </div>

                <div class="form_item col-span-12 md:col-span-6 p-2">
                    <p class="text-base text-left">
                        <span class="text-lg text-left font-bold">
                            Question
                        </span>
                        <span class="text-base text-left pl-2 block">
                            {{ single_term.question }}
                        </span>
                    </p>
                </div>

                <div class="form_item col-span-12 md:col-span-6 p-2">
                    <p class="text-base text-left">
                        <span class="text-lg text-left font-bold">
                            Question in English
                        </span>
                        <span class="text-base text-left pl-2 block">
                            {{ single_term.question_en }}
                        </span>
                    </p>
                </div>

                <div class="form_item col-span-12 md:col-span-6 p-2">
                    <p class="text-base text-left">
                        <span class="text-lg text-left font-bold">
                            Answer
                        </span>
                        <span class="text-base text-left pl-2 block">
                            {{ single_term.answer }}
                        </span>
                    </p>
                </div>

                <div class="form_item col-span-12 md:col-span-6 p-2">
                    <p class="text-base text-left">
                        <span class="text-lg text-left font-bold">
                            Answer in English
                        </span>
                        <span class="text-base text-left pl-2 block">
                            {{ single_term.answer_en }}
                        </span>
                    </p>
                </div>

            </div>

        </div>

    </div>

</template>
