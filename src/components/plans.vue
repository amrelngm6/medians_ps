<template>
    <div class=" w-full">

        <div class="px-4 mb-6 py-4 rounded-lg shadow-md bg-white dark:bg-gray-700 flex w-full">
            <h1 class="font-bold text-lg w-full" v-text="content.title"></h1>
            <a href="javascript:;" class="menu-dark uppercase p-2 mx-2 text-center text-white w-32 rounded bg-danger"
                @click="showAddSide = true">{{ translate('add_new') }}</a>
        </div>
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body px-10 px-lg-20  pb-10">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-striped gy-7">
                        <!--begin::Table head-->
                        <thead class="align-middle">
                            <tr id="kt_pricing" v-if="content && content.items">
                                <th>
                                    <!--begin::Nav group-->
                                    <div class="nav bg-light rounded-pill px-3 py-2 ms-9 mb-15 w-225px"
                                        data-kt-buttons="true" data-kt-initialized="1">
                                        <button v-for="item in ['Monthly', 'Annually']" v-text="translate(item)"
                                            @click="setActiveStatus(item)"
                                            :class="activeStatus == item ? 'active text-white' : ''"
                                            class="nav-link btn btn-active btn-active-dark fw-bold btn-color-gray-600 py-3 px-5 m-1 rounded-pill"></button>
                                    </div>
                                    <!--end::Nav group-->
                                </th>

                                <th class="text-center min-w-200px" v-for="(item, index) in content.items">
                                    <div class="min-w-200px mb-15">
                                        <div class="text-primary fs-3 fw-bold mb-7" v-text="item.name"></div>

                                        <div
                                            class="fs-5x fw-semibold d-flex justify-content-center align-items-start lh-sm">
                                            <span class="align-self-start fs-2 mt-3" v-text="currency.symbol"></span>
                                            <span
                                                v-text="activeStatus == 'Monthly' ? item.monthly_cost : item.yearly_cost"></span>
                                        </div>

                                        <div class="text-muted fw-bold mb-7" v-text="activeStatus"></div>

                                        <div class="w-full flex gap-4">
                                            <a href="#" @click="handleAction('edit', item)" class="btn btn-light-primary fw-bold mx-auto" v-text="translate('Edit')"></a>
                                            <a href="#" @click="handleAction('delete', item)" class="btn btn-danger fw-bold mx-auto text-white" v-text="translate('Delete')"></a>
                                        </div>

                                    </div>
                                </th>

                            </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            <tr v-for="feature in content.features">
                                <th class="card-rounded-start">
                                    <div class="fw-bold d-flex align-items-center ps-9 fs-3" v-text="feature.title"></div>
                                </th>

                                <td v-for="plan in content.items">
                                    <div v-for="p_feature in plan.plan_features">
                                        <div v-if="p_feature.code == feature.code"
                                            class="flex-root d-flex justify-content-center">
                                            <span class="h-40px w-40px d-flex flex-center d-block">
                                                <vue-feather v-if="p_feature.type == 'boolen' && p_feature.access > 0"
                                                    type="check-circle"></vue-feather>
                                                <vue-feather v-if="p_feature.type == 'boolen' && p_feature.access == 0"
                                                    type="x-circle"></vue-feather>
                                                <span v-if="p_feature.type == 'value'" v-text="p_feature.access"></span>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Card body-->
        </div>
        
        <side_form_create ref="activeFormCreate" @callback="closeSide" :auth="auth" :conf="conf" :model="'Plan.create'" v-if="showAddSide && !showEditSide" :columns="content.fillable"  class="col-md-3" />
            
        <side-form-update ref="activeFormUpdate" @callback="closeSide" :key="activeItem" :auth="auth" :conf="conf" :model="'Plan.update'" v-if="showEditSide && !showAddSide" :item="activeItem" :model_id="activeItem[object_key]" :index="object_key"  :columns="content.fillable"  class="col-md-3" />

    </div>
</template>
<script>

import data_table_page from './data_table_page.vue';

import { defineAsyncComponent, ref } from 'vue';
import { translate, handleGetRequest, deleteByKey } from '@/utils.vue';

const SideFormCreate = defineAsyncComponent(() =>
  import('@/components/includes/side-form-create.vue')
);
const SideFormUpdate = defineAsyncComponent(() =>
  import('@/components/includes/side-form-update.vue')
);

export default
    {
        components: {
            'side_form_create': SideFormCreate,
            SideFormUpdate,
            translate,
            data_table_page
        },
        emit: [
            'update', 'close'
        ],
        setup(props, { emit }) {

            const url = props.conf.url + props.path + '?load=json';

            const showAddSide = ref(false);
            const showEditSide = ref(false);
            const activeStatus = ref('Monthly');
            const activeItem = ref({});

            const content = ref({
                title: '',
                items: [],
                columns: [],
            });

            const closeSide = (data) =>  
            {
                showAddSide.value = false;
                showEditSide.value = false;
            }

            
            const load = () => {
                handleGetRequest(url).then(response => {
                    content.value = JSON.parse(JSON.stringify(response))
                });
            }

            load();

            const setActiveStatus = (access) => {
                activeStatus.value = access;
            }


            const update = () => {
                emit('save', 'save', activeItem.value);
            }

            const close = () => {
                emit('close', 'close', activeItem.value);
            }

            /**
             * Handle actions from datatable buttons
             * Called From 'dataTableActions' component
             * 
             * @param String actionName 
             * @param Object data
             */
            function handleAction(actionName, data) {
                switch (actionName) {
                    case 'edit':
                        activeItem.value = data;
                        showEditSide.value = true;
                        break;

                    case 'delete':
                        deleteByKey('plan_id', data, 'Plan.delete');
                        break;
                }
            }

            return {
                url,
                showAddSide,
                showEditSide,
                content,
                activeItem,
                activeStatus,
                handleAction,
                closeSide,
                close,
                update,
                setActiveStatus,
                translate,
            };
        },

        props: [
            'path',
            'lang',
            'setting',
            'conf',
            'auth',
            'item',
            'currency',
        ],
    };
</script>