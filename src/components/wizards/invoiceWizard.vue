<template>
    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Invoice 1
                    </h1>
                    <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="/metronic8/demo1/index.html" class="text-muted text-hover-primary">
                                Home </a>
                        </li>

                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>


                        <li class="breadcrumb-item text-muted">
                            Invoice Manager </li>

                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>


                        <li class="breadcrumb-item text-muted">
                            View Invoices </li>


                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-6 text-muted me-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                            Filter
                        </a>
                        <!--end::Menu toggle-->



                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                            id="kt_menu_661c4f45d9d8f">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                            </div>

                            <div class="separator border-gray-200"></div>
                            
                            <div class="px-7 py-5">
                                
                                <div class="mb-10">
                                    
                                    <label class="form-label fw-semibold">Status:</label>
                                    

                                    
                                    <div>
                                        <select class="form-select form-select-solid select2-hidden-accessible"
                                            multiple="" data-kt-select2="true" data-close-on-select="false"
                                            data-placeholder="Select option"
                                            data-dropdown-parent="#kt_menu_661c4f45d9d8f" data-allow-clear="true"
                                            data-select2-id="select2-data-7-0u96" tabindex="-1" aria-hidden="true"
                                            data-kt-initialized="1">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="2">In Process</option>
                                            <option value="2">Rejected</option>
                                        </select><span class="select2 select2-container select2-container--bootstrap5"
                                            dir="ltr" data-select2-id="select2-data-8-i6jm" style="width: 100%;"><span
                                                class="selection"><span
                                                    class="select2-selection select2-selection--multiple form-select form-select-solid"
                                                    role="combobox" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="-1" aria-disabled="false">
                                                    <ul class="select2-selection__rendered" id="select2-vm28-container">
                                                    </ul><span class="select2-search select2-search--inline"><textarea
                                                            class="select2-search__field" type="search" tabindex="0"
                                                            autocorrect="off" autocapitalize="none" spellcheck="false"
                                                            role="searchbox" aria-autocomplete="list" autocomplete="off"
                                                            aria-label="Search"
                                                            aria-describedby="select2-vm28-container"
                                                            placeholder="Select option"
                                                            style="width: 100%;"></textarea></span>
                                                </span></span><span class="dropdown-wrapper"
                                                aria-hidden="true"></span></span>
                                    </div>
                                    
                                </div>

                                
                                <div class="mb-10">
                                    
                                    <label class="form-label fw-semibold">Member Type:</label>
                                    

                                    <div class="d-flex">
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" value="1">
                                            <span class="form-check-label">
                                                Author
                                            </span>
                                        </label>
                                        <!--end::Options-->

                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="2" checked="checked">
                                            <span class="form-check-label">
                                                Customer
                                            </span>
                                        </label>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Input group-->

                                
                                <div class="mb-10">
                                    
                                    <label class="form-label fw-semibold">Notifications:</label>
                                    

                                    <!--begin::Switch-->
                                    <div
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="notifications"
                                            checked="">
                                        <label class="form-check-label">
                                            Enabled
                                        </label>
                                    </div>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                        data-kt-menu-dismiss="true">Reset</button>

                                    <button type="submit" class="btn btn-sm btn-primary"
                                        data-kt-menu-dismiss="true">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::Filter menu-->


                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->

                    <!--begin::Primary button-->
                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_create_app">
                        Create </a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">


            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <!--begin::Invoice 2 main-->
                <div class="card">
                    <!--begin::Body-->
                    <div class="card-body p-lg-20">
                        <!--begin::Layout-->
                        <div class="d-flex flex-column flex-xl-row">
                            <!--begin::Content-->
                            <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                                <!--begin::Invoice 2 content-->
                                <div class="mt-n1">
                                    <!--begin::Top-->
                                    <div class="d-flex flex-stack pb-10">
                                        <!--begin::Logo-->
                                        <a href="#">
                                            <img alt="Logo"
                                                :src="'/metronic8/demo1/assets/media/svg/brand-logos/code-lab.svg'">
                                        </a>
                                        <!--end::Logo-->

                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-sm btn-success">Pay Now</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Top-->

                                    <!--begin::Wrapper-->
                                    <div class="m-0">
                                        
                                        <div class="fw-bold fs-3 text-gray-800 mb-8">Invoice #34782</div>
                                        

                                        <!--begin::Row-->
                                        <div class="row g-5 mb-11">
                                            <!--end::Col-->
                                            <div class="col-sm-6">
                                                
                                                <div class="fw-semibold fs-7 text-gray-600 mb-1">Issue Date:</div>
                                                

                                                <!--end::Col-->
                                                <div class="fw-bold fs-6 text-gray-800">12 Apr 2021</div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Col-->

                                            <!--end::Col-->
                                            <div class="col-sm-6">
                                                
                                                <div class="fw-semibold fs-7 text-gray-600 mb-1">Due Date:</div>
                                                

                                                <!--end::Info-->
                                                <div
                                                    class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                                                    <span class="pe-2">02 May 2021</span>

                                                    <span class="fs-7 text-danger d-flex align-items-center">
                                                        <span class="bullet bullet-dot bg-danger me-2"></span>

                                                        Due in 7 days
                                                    </span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->

                                        <!--begin::Row-->
                                        <div class="row g-5 mb-12">
                                            <!--end::Col-->
                                            <div class="col-sm-6">
                                                
                                                <div class="fw-semibold fs-7 text-gray-600 mb-1">Issue For:</div>
                                                

                                                <!--end::Text-->
                                                <div class="fw-bold fs-6 text-gray-800">KeenThemes Inc.</div>
                                                <!--end::Text-->

                                                <!--end::Description-->
                                                <div class="fw-semibold fs-7 text-gray-600">
                                                    8692 Wild Rose Drive <br>
                                                    Livonia, MI 48150
                                                </div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Col-->

                                            <!--end::Col-->
                                            <div class="col-sm-6">
                                                
                                                <div class="fw-semibold fs-7 text-gray-600 mb-1">Issued By:</div>
                                                

                                                <!--end::Text-->
                                                <div class="fw-bold fs-6 text-gray-800">CodeLab Inc.</div>
                                                <!--end::Text-->

                                                <!--end::Description-->
                                                <div class="fw-semibold fs-7 text-gray-600">
                                                    9858 South 53rd Ave.<br>
                                                    Matthews, NC 28104
                                                </div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->


                                        <!--begin::Content-->
                                        <div class="flex-grow-1">
                                            <!--begin::Table-->
                                            <div class="table-responsive border-bottom mb-9">
                                                <table class="table mb-3">
                                                    <thead>
                                                        <tr class="border-bottom fs-6 fw-bold text-muted">
                                                            <th class="min-w-175px pb-2">Description</th>
                                                            <th class="min-w-70px text-end pb-2">Hours</th>
                                                            <th class="min-w-80px text-end pb-2">Rate</th>
                                                            <th class="min-w-100px text-end pb-2">Amount</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr class="fw-bold text-gray-700 fs-5 text-end">
                                                            <td class="d-flex align-items-center pt-6">
                                                                <i class="fa fa-genderless text-danger fs-2 me-2"></i>

                                                                Creative Design
                                                            </td>

                                                            <td class="pt-6">80</td>
                                                            <td class="pt-6">$40.00</td>
                                                            <td class="pt-6 text-gray-900 fw-bolder">$3200.00</td>
                                                        </tr>

                                                        <tr class="fw-bold text-gray-700 fs-5 text-end">
                                                            <td class="d-flex align-items-center">
                                                                <i class="fa fa-genderless text-success fs-2 me-2"></i>

                                                                Logo Design
                                                            </td>

                                                            <td>120</td>
                                                            <td>$40.00</td>
                                                            <td class="fs-5 text-gray-900 fw-bolder">$4800.00</td>
                                                        </tr>

                                                        <tr class="fw-bold text-gray-700 fs-5 text-end">
                                                            <td class="d-flex align-items-center">
                                                                <i class="fa fa-genderless text-primary fs-2 me-2"></i>

                                                                Web Development
                                                            </td>

                                                            <td>210</td>
                                                            <td>$60.00</td>
                                                            <td class="fs-5 text-gray-900 fw-bolder">$12600.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end::Table-->

                                            <!--begin::Container-->
                                            <div class="d-flex justify-content-end">
                                                <!--begin::Section-->
                                                <div class="mw-300px">
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-3">
                                                        <!--begin::Accountname-->
                                                        <div class="fw-semibold pe-10 text-gray-600 fs-7">Subtotal:
                                                        </div>
                                                        <!--end::Accountname-->

                                                        
                                                        <div class="text-end fw-bold fs-6 text-gray-800">$ 20,600.00
                                                        </div>
                                                        
                                                    </div>
                            

                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-3">
                                                        <!--begin::Accountname-->
                                                        <div class="fw-semibold pe-10 text-gray-600 fs-7">VAT 0%</div>
                                                        <!--end::Accountname-->

                                                        
                                                        <div class="text-end fw-bold fs-6 text-gray-800">0.00</div>
                                                        
                                                    </div>
                            

                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack mb-3">
                                                        <!--begin::Accountnumber-->
                                                        <div class="fw-semibold pe-10 text-gray-600 fs-7">Subtotal + VAT
                                                        </div>
                                                        <!--end::Accountnumber-->

                                                        <!--begin::Number-->
                                                        <div class="text-end fw-bold fs-6 text-gray-800">$ 20,600.00
                                                        </div>
                                                        <!--end::Number-->
                                                    </div>
                            

                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-stack">
                                                        <!--begin::Code-->
                                                        <div class="fw-semibold pe-10 text-gray-600 fs-7">Total</div>
                                                        <!--end::Code-->

                                                        
                                                        <div class="text-end fw-bold fs-6 text-gray-800">$ 20,600.00
                                                        </div>
                                                        
                                                    </div>
                            
                                                </div>
                                                <!--end::Section-->
                                            </div>
                                            <!--end::Container-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Invoice 2 content-->
                            </div>
                            <!--end::Content-->

                            <!--begin::Sidebar-->
                            <div class="m-0">
                                <!--begin::Invoice 2 sidebar-->
                                <div
                                    class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
                                    <!--begin::Labels-->
                                    <div class="mb-8">
                                        <span class="badge badge-light-success me-2">Approved</span>

                                        <span class="badge badge-light-warning">Pending Payment</span>
                                    </div>
                                    <!--end::Labels-->

                                    <!--begin::Title-->
                                    <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary">PAYMENT DETAILS</h6>
                                    <!--end::Title-->

                                    <!--begin::Item-->
                                    <div class="mb-6">
                                        <div class="fw-semibold text-gray-600 fs-7">Paypal:</div>

                                        <div class="fw-bold text-gray-800 fs-6">codelabpay@codelab.co</div>
                                    </div>
            

                                    <!--begin::Item-->
                                    <div class="mb-6">
                                        <div class="fw-semibold text-gray-600 fs-7">Account:</div>

                                        <div class="fw-bold text-gray-800 fs-6">
                                            Nl24IBAN34553477847370033 <br>
                                            AMB NLANBZTC
                                        </div>
                                    </div>
            

                                    <!--begin::Item-->
                                    <div class="mb-15">
                                        <div class="fw-semibold text-gray-600 fs-7">Payment Term:</div>

                                        <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center">
                                            14 days

                                            <span class="fs-7 text-danger d-flex align-items-center">
                                                <span class="bullet bullet-dot bg-danger mx-2"></span>

                                                Due in 7 days
                                            </span>
                                        </div>
                                    </div>
            

                                    <!--begin::Title-->
                                    <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary">PROJECT OVERVIEW</h6>
                                    <!--end::Title-->

                                    <!--begin::Item-->
                                    <div class="mb-6">
                                        <div class="fw-semibold text-gray-600 fs-7">Project Name</div>

                                        <div class="fw-bold fs-6 text-gray-800">
                                            SaaS App Quickstarter

                                            <a href="#" class="link-primary ps-1">View Project</a>
                                        </div>
                                    </div>
            

                                    <!--begin::Item-->
                                    <div class="mb-6">
                                        <div class="fw-semibold text-gray-600 fs-7">Completed By:</div>

                                        <div class="fw-bold text-gray-800 fs-6">Mr. Dewonte Paul</div>
                                    </div>
            

                                    <!--begin::Item-->
                                    <div class="m-0">
                                        <div class="fw-semibold text-gray-600 fs-7">Time Spent:</div>

                                        <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center">
                                            230 Hours

                                            <span class="fs-7 text-success d-flex align-items-center">
                                                <span class="bullet bullet-dot bg-success mx-2"></span>

                                                35$/h Rate
                                            </span>
                                        </div>
                                    </div>
            
                                </div>
                                <!--end::Invoice 2 sidebar-->
                            </div>
                            <!--end::Sidebar-->
                        </div>
                        <!--end::Layout-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Invoice 2 main-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->

    </div>
</template>
<script>

import close_icon from '@/components/svgs/Close.vue';
import delete_icon from '@/components/svgs/trash.vue';
import route_icon from '@/components/svgs/route.vue';
import car_icon from '@/components/svgs/car.vue';

import 'vue3-easy-data-table/dist/style.css';
import Vue3EasyDataTable from 'vue3-easy-data-table';

import { defineAsyncComponent, ref } from 'vue';
import { translate, getProgressWidth, durationMonthsDate, handleRequest, deleteByKey, showAlert, handleAccess, getPositionAddress, findPlaces, getPlaceDetails } from '@/utils.vue';

const maps = defineAsyncComponent(() =>
    import('@/components/includes/map.vue')
);
const SideFormCreate = defineAsyncComponent(() =>
    import('@/components/includes/side-form-create.vue')
);

const SideFormUpdate = defineAsyncComponent(() =>
    import('@/components/includes/side-form-update.vue')
);

const form_field = defineAsyncComponent(() =>
    import('@/components/includes/form_field.vue')
);
import editable_map_location from '@/components/includes/editable_map_location.vue';
import route_map from '@/components/maps/route_map.vue';

export default
    {
        components: {
            'datatabble': Vue3EasyDataTable,
            SideFormCreate,
            SideFormUpdate,
            maps,
            close_icon,
            delete_icon,
            car_icon,
            route_icon,
            form_field,
            editable_map_location,
            route_map
        },
        name: 'PackageSubscriptions',
        emits: ['callback'],
        setup(props, { emit }) {

            const showEditSide = ref(false);
            const activeItem = ref({});
            const activeTab = ref(props.usertype);
            const content = ref({});
            const fillable = ref([props.usertype, 'Package', 'Subscription', 'Confirm']);
            const searchText = ref('');

            if (props.item) {
                activeItem.value = props.item
            }

            const savePackageSubscription = () => {
                var params = new URLSearchParams();
                let array = JSON.parse(JSON.stringify(activeItem.value));
                let keys = Object.keys(array)
                let k, d, value = '';
                for (let i = 0; i < keys.length; i++) {
                    k = keys[i]
                    d = typeof array[k] === 'object' ? JSON.stringify(array[k]) : array[k]
                    params.append('params[' + k + ']', d)
                }

                let type = array.subscription_id > 0 ? 'update' : 'create';
                params.append('type', 'PackageSubscription.' + type)
                handleRequest(params, '/api/' + type).then(response => {
                    handleAccess(response)
                })
            }

            const back = () => {
                emit('callback');
            }


            const progressWidth = () => {
                let requiredData = ['model_id', 'package_id', 'start_date', 'payment_type', 'daily_trips', 'payment_status'];

                return getProgressWidth(requiredData, activeItem);
            }

            const checkSimilarUser = (item) => {
                let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                let email = name ? name : (item.mobile).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return email ? email : ((item.parent.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false);
            }

            const setUser = (model) => {
                activeItem.value.model_id = props.usertype == 'student' ? model.student_id : model.customer_id;
                activeItem.value.model = model;
                activeItem.value.user_type = props.usertype;
                activeTab.value = 'Package';
                searchText.value = null;
            }

            const findUser = () => {
                for (let i = 0; i < props.userslist.length; i++) {
                    props.userslist[i].show = searchText.value.trim() ? checkSimilarUser(props.userslist[i]) : 1;
                }
            }


            const checkSimilarPackage = (item) => {
                let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return name ? name : ((item.description).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false);
            }

            const setPackage = (packageItem) => {
                activeItem.value.package_id = packageItem.package_id;
                activeItem.value.package = packageItem;
                activeTab.value = 'Subscription';
                searchText.value = null;
            }

            const findPackage = () => {
                if (props.packages) {
                    for (let i = 0; i < props.packages.length; i++) {
                        props.packages[i].show = searchText.value.trim() ? checkSimilarPackage(props.packages[i]) : 1;
                    }
                }
            }

            const setType = (val) => {
                activeItem.value.payment_type = val;
                dateChanged()
            }

            const dateChanged = () => {

                if (!activeItem.value.start_date)
                    return null;

                let value = 0;
                if (activeItem.value.payment_type == 'month')
                    value = 1;

                if (activeItem.value.payment_type == 'quarter')
                    value = 3;

                if (activeItem.value.payment_type == 'year')
                    value = 12;

                activeItem.value.end_date = durationMonthsDate(activeItem.value.start_date, value);
            }

            const showTip = ref(false);

            const totalCost = () => {

                let priceType = (activeItem.value.daily_trips == 1) ? ('single_cost_' + activeItem.value.payment_type) : ('double_cost_' + activeItem.value.payment_type);

                activeItem.value.total_cost = activeItem.value.package[priceType];

                return activeItem.value.total_cost;
            }


            return {
                totalCost,
                showTip,
                dateChanged,
                setType,
                findPackage,
                checkSimilarPackage,
                setPackage,
                findUser,
                setUser,
                checkSimilarUser,
                progressWidth,
                showEditSide,
                content,
                fillable,
                activeItem,
                activeTab,
                translate,
                savePackageSubscription,
                searchText,
                back
            };
        },

        props: [
            'conf',
            'path',
            'system_setting',
            'business_setting',
            'item',
            'userslist',
            'usertype',
            'packages',
        ],

    };
</script>