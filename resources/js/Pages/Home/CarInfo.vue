<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            내 차 정보 입력
        </template>

        <template #description>
            소유한 차량의 정보를 입력해주세요
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">

                <jet-label for="image" value="image" />
                <input type="file" id="image" class="hidden" ref="image" @change="updateImagePreview">
                <div class="mt-2" v-show="imagePreview">
                    <span class="block w-20 h-20 bg-center bg-no-repeat bg-cover rounded-full" :style="'background-image: url(\'' + imagePreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.prevent="selectNewImage">
                    Select A New Image
                </jet-secondary-button>
                
                <jet-input-error :message="form.errors.image" class="mt-2" />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="carname" value="차량명" />
                <jet-input id="carname" type="text" class="mt-1 block w-full" v-model="form.carname" autocomplete="carname" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Car Number -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="carnum" value="차량 번호" />
                <jet-input id="carnum" type="text" class="mt-1 block w-full" v-model="form.carnum" autocomplete="carnum" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Brand -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="brand" value="제조사" />
                <jet-input id="brand" type="text" class="mt-1 block w-full" v-model="form.brand" autocomplete="brand" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button @click="saveCarInfo" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'POST',
                    id: this.user.id,
                    carname: null,
                    carnum: null,
                    brand: null,
                    image: null,
                }),
                imagePreview: null,
            }
        },

        methods: {
           saveCarInfo() {
                if(this.$refs.image) {
                    this.form.image = this.$refs.image.files[0]
                }
                this.form.post('/storecarinfo', this.form)
           },
            updateImagePreview() {
                const photo = this.$refs.image.files[0];
                if(! photo) return;
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };

                reader.readAsDataURL(photo);
            },

            selectNewImage() {
                this.$refs.image.click();
            },
        },
    })
</script>
