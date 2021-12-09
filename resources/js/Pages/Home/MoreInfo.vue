<template>
    <app-layout title="차량 상세정보">
        <template #header>
            <h2 class="text-xl font-smibold leading-tight text-gray-800">
                차량 상세정보
            </h2>
        </template>
        <div class="py-12">
            <div class ="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <label class="text-xl text-gray-600">차량 이름</label>
                            <div class="w-full p-2 border-2 border-gray-300">{{ car.carname }}</div>
                        </div>

                        <div class="mb-4">
                            <label class="text-xl text-gray-600">차량 번호</label>
                            <div class="w-full p-2 border-2 border-gray-300">{{ car.carnum }}</div>
                        </div>

                        <div class="mb-8">
                            <label class="text-xl text-gray-600">브랜드</label>
                            <div class="w-full p-2 border-2 border-gray-300">{{ car.brand }}</div>
                        </div>
                        <div class="flex p-1 mb-8">
                            <button @click="open_update_modal" class="btn btn-primary" required>수정</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <jet-dialog-modal :show="confirmUpdate" @close="confirmUpdate=false">
            <template #title>
                차량 정보 수정
            </template>
            <template #content>
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
                
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
                </div>
                <div class="mb-4">
                    <label class="text-xl text-gray-600">차량명</label>
                    <input type="text" class="w-full p-2 border-2 border-gray-300" v-model="form.carname">
                </div>

                <div class="mb-4">
                    <label class="text-xl text-gray-600">차량 번호</label>
                    <input type="text" class="w-full p-2 border-2 border-gray-300" v-model="form.carnum">
                </div>

                <div class="mb-4">
                    <label class="text-xl text-gray-600">브랜드</label>
                    <input type="text" class="w-full p-2 border-2 border-gray-300" v-model="form.brand">
                </div>
            </template>
            <template #footer>
                <jet-secondary-button @click.native="confirmUpdate=false">
                    Cancel
                </jet-secondary-button>
                <jet-danger-button class="ml-2" @click.native="update_class">
                    Update
                </jet-danger-button>
            </template>
        </jet-dialog-modal>

    </app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'

export default defineComponent({
    props:['user','car'],
    components: {
        AppLayout,
        JetDialogModal,
    },
    data() {
        return {
            form: this.$inertia.form({
                '_method':'PUT',
                carname:'',
                carnum: '',
                brand: '',
                image: this.car.image
            }),
            confirmUpdate: false,
            imagePreview: this.car.image
        }
    },
    methods: {
        open_update_modal() {
            if(this.$refs.image) {
                    this.form.image = this.$refs.image.files[0]
                }
            this.form.carname = this.car.carname;
            this.form.carnum = this.car.carnum;
            this.form.brand = this.car.brand;
            this.confirmUpdate = true;
        },
        update_class() {
            if(this.$refs.image) {
                    this.form.image = this.$refs.image.files[0]
            }
            this.$inertia.post('/updatecar/'+this.car.id, this.form, {
                onSuccess:()=>{
                    this.confirmUpdate = false;
                }
            });
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
    }
})
</script>
