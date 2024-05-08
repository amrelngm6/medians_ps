<template>
    <div class="w-full " >
        <div class="card">
            <div class="card-body relative">
                <div class="card-px text-center pt-15 pb-15">
                    <h2 class="fs-2x fw-bold mb-0" v-text="translate('Choose user type')"></h2>
                    <p class="text-gray-400 fs-4 font-semibold py-7"
                        v-text="translate('Define the required user type to complete information')"></p>
                </div>

                <div class="text-center pb-15 px-5">
                    <div class="relative mx-auto max-w-6xl py-4">
                        <div class="w-full flex gap-10">
                            <div class="w-full" v-if="auth && auth.business.type == 'school'" @click="disable_students ? null : setType('parent')">
                                <input type="radio" class="btn-check" value="parents"
                                    :checked="activeItem.usertype == 'parents' ? true : false"
                                    name="payment_type" />
                                <label :class="disable_students ? 'disabled' : ''" 
                                    class="gap-6 btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10">
                                    <vue-feather type="users"></vue-feather>
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-gray-900 fw-bold d-block fs-4 mb-2"
                                            v-text="translate('Parent')"></span>
                                        <span class="text-muted fw-semibold fs-6"
                                            v-text="alias"></span>
                                    </span>
                                </label>
                            </div>

                            <div class="w-full" @click="setType('employee')">
                                <input type="radio" class="btn-check" value="employee"
                                    :checked="activeItem.usertype == 'employee' ? true : false"
                                    name="usertype" />
                                <label
                                    class="gap-6 btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10">
                                    <vue-feather type="user"></vue-feather>
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-gray-900 fw-bold d-block fs-4 mb-2"
                                            v-text="translate('Employee')"></span>
                                        <span class="text-muted fw-semibold fs-6"
                                            v-text="alias"></span>
                                    </span>
                                </label>
                            </div>

                            <div class="w-full" @click="setType('supervisor')">
                                <input type="radio" class="btn-check" value="supervisor"
                                    :checked="activeItem.usertype == 'supervisor' ? true : false"
                                    name="usertype" />
                                <label
                                    class="gap-6 btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10">
                                    <vue-feather type="user-check"></vue-feather>
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-gray-900 fw-bold d-block fs-4 mb-2"
                                            v-text="translate('Supervisor')"></span>
                                        <span class="text-muted fw-semibold fs-6"
                                            v-text="alias"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import { ref} from 'vue';
import {translate} from '@/utils.vue';

export default 
{
    emits:['callback'],

    setup(props, {emit}) {

        const activeItem = props.item;
        
        const setType = (type) => {
            emit('callback', type)
        }

        return {
            setType,
            activeItem,
            translate,
        };
    },

    props: [
        'path',
        'lang',
        'system_setting',
        'business_setting',
        'setting',
        'conf',
        'auth',
        'item',
        'disable_students',
        'alias'
    ],
    
};
</script>