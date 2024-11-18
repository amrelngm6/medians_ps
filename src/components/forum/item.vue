<template>
    <div class=" w-full">

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="card mt-n4 mx-n4 card-border-effect-none mb-n5 border-bottom-0 border-start-0 rounded-0">
                        <div class="card-body pb-4 mb-0">
                            <div class="row">
                                <div class="col-md">
                                    <div class="flex align-items-center">
                                        <div class="px-1 pt-1">
                                            <vue-feather type="clipboard"></vue-feather>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md">
                                            <h4 class="fw-semibold px-1" id="ticket-title" v-text="item.customer_name">
                                            </h4>
                                            <div class="hstack gap-3 flex h-8">
                                                <div class="vr"></div>
                                                <div class="text-muted"><span v-text="translate('Created at')"></span> :
                                                    <span class="fw-medium " id="create-date" v-text="item.date"></span>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="text-muted"><span v-text="translate('Last update')"></span>
                                                    : <span class="fw-medium " id="update-date"
                                                        v-text="item.update_date"></span></div>
                                                <div class="vr"></div>
                                                <div class="badge rounded-pill fs-12 text-white" id="ticket-status"
                                                    v-if="item.status"
                                                    v-text="item.status == '0' ? 'disabled' : 'active'"
                                                    :class="item.status == '0' ? 'bg-info' : 'bg-success'"></div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <span class="w-auto py-2 px-4 cursor-pointer text-lg"
                                            @click="emit('callback')"><vue-feather class="w-5"
                                                type="x-circle"></vue-feather></span>
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="lg:flex gap-6 mt-4">
                <div class="col-xxl-9  col-lg-8 w-full">
                    <div class="card">
                        <div class="card-body p-4">
                            <h6 class="fw-semibold text-uppercase mb-3" v-text="translate('Ticket Discripation')"></h6>
                            <h3 class="fw-semibold text-uppercase mb-3" v-text="item.subject"></h3>
                            <p class="text-muted font-bold pt-10" v-text="item.content"></p>
                        </div>
                        <!--end card-body-->
                        <div class="card-body p-4">
                            <h5 class="card-title text-sm font-semibold mb-4" v-text="translate('Comments')"></h5>

                            <div data-simplebar="init" style="max-height: 300px;" class="overflow-y-auto">
                                <div class="simplebar-wrapper">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content">
                                                <div class="simplebar-content">
                                                    <div class="flex gap-2 mb-4" v-for="comment in item.comments">
                                                        <div class="flex-grow-1 ms-3" v-if="comment.user_name">
                                                            <h5 class="fs-13 flex gap-2"><span
                                                                    v-text="comment.user_name"></span>
                                                                <small class="text-muted" v-text="comment.date"></small>
                                                                
                                                                <label class="py-4 flex gap gap-2 cursor-pointer" >
                                                                    <span :class="comment.status == 'on' ? 'bg-gray-200' : 'bg-red-400'" class="mx-2 mt-1 bg-red-400 block h-4 relative rounded-full w-8" style="direction: ltr;" ><a class="absolute bg-white block h-4 relative right-0 rounded-full w-4" :style="{left: comment.status == 'on' ? '16px' : 0}"></a></span>
                                                                    <input value="on" :checked="comment.status == 'on' ? false : true" @change="setCommentStatus(comment)"  type="checkbox" class="hidden" />
                                                                </label>
                                                                
                                                            </h5>
                                                            <p class="text-muted" v-text="comment.content"></p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="/api/create" method="POST" data-refresh="1" id="add-comment-form"
                                class="action my-2 rounded-lg  pb-2">
                                <input name="type" type="hidden" value="ForumComment.create">
                                <input name="params[item_id]" type="hidden" :value="item.id">

                                <div class="lg:px-0  gap-6 sm:flex sm:items-center sm:justify-between sm:py-4 sm:px-6">
                                    <dd class="w-full mt-1  text-gray-900 sm:mt-0 ">
                                        <p v-text="translate('Name')"></p>
                                        <input 
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-first-name" type="text" :placeholder="translate('Name')"
                                            name="params[user_name]">

                                    </dd>
                                    <dd class="w-full mt-1  text-gray-900 sm:mt-0 ">
                                        <p v-text="translate('Email')"></p>
                                        <input type="email" 
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-email" :placeholder="translate('ENTER Email')"
                                            name="params[user_email]">

                                    </dd>
                                </div>

                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <label for="exampleFormControlTextarea1" class="form-label" v-text="translate('WRITE_COMMENT')"></label>
                                        <textarea name="params[content]" class="form-control bg-light border-light"
                                            id="exampleFormControlTextarea1" rows="3" placeholder="Enter comments"></textarea>
                                    </div>
                                    <div class="col-lg-12 text-end mt-4">
                                        <button type="submit" class="btn btn-primary" v-text="translate('Send')"></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <!-- end card body -->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-xxl-3 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0" v-text="translate('Ticket Details')"></h5>
                        </div>
                        <div class="card-body">
                            <form action="/api/update" method="POST" id="edit-item-form"
                                class="action my-2 rounded-lg  pb-2">
                                <input name="type" type="hidden" value="Forum.update">
                                <input name="params[id]" type="hidden" :value="item.id">

                                <div class="table-responsive table-card">
                                    <table class="table table-borderless align-middle mb-0 w-full">
                                        <tbody>
                                            <tr>
                                                <td class="fw-medium py-2 " v-text="translate('ID')"></td>
                                                <td class="py-2">#<a target="_blank" :href="'/forum-post/'+item.id" v-text="item.id"></a> </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium py-2 " v-text="translate('Assigned Doctor')"></td>
                                                <td id="t-client" class="py-2">
                                                    <select v-model="item.doctor_id" name="params[doctor_id]"
                                                        class="form-control form-control-solid border border-gray-600">
                                                        <option v-for="doctor in doctors" v-text="doctor.title"
                                                            :value="doctor.id"></option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium py-2 " v-text="translate('Category')"></td>
                                                <td id="t-client" class="py-2">
                                                    <select v-model="item.category_id" name="params[category_id]"
                                                        class="form-control form-control-solid border border-gray-600">
                                                        <option v-for="category in categories" v-text="category.title"
                                                            :value="category.id"></option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="fw-medium py-2 " v-text="translate('Status')"></td>
                                                <td id="t-client" class="py-2">
                                                    <select v-model="item.status" name="params[status]"
                                                        class="form-control form-control-solid border border-gray-600">
                                                        <option v-text="translate('Active')" value="on"></option>
                                                        <option v-text="translate('Inactive')" value="0"></option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="fw-medium py-2" v-text="translate('Name')"></td>
                                                <td class="py-2" v-text="item.customer_name"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium py-2 " v-text="translate('Email')"></td>
                                                <td class="py-2" v-text="item.customer_email"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium py-2 " v-text="translate('Phone')"></td>
                                                <td class="py-2" v-text="item.customer_phone"></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-medium py-2 "></td>
                                                <td id="d-date" class="py-2 flex">
                                                    <button v-text="translate('Update')" type="submit"
                                                        class="btn btn-danger  block text-center"></button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </form>

                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
    </div>
</template>
<script>
import { translate, handleGetRequest, handleRequest, showAlert } from '@/utils.vue';

export default
    {
        components: {
            translate
        },
        emits: ['callback'],
        setup(props, { emit }) {

            const close = () => {

                if (!window.confirm(translate('confirm_close_ticket'))) {
                    return null;
                }

                var params = new URLSearchParams();
                params.append('type', 'HelpMessage.close')
                params.append('params[message_id]', props.item.message_id)
                params.append('params[status]', 'completed')
                handleRequest(params, '/api/update').then(response => {
                    showAlert(response.result)
                })
            }

            const setCommentStatus = (comment) => {

                var params = new URLSearchParams();
                params.append('type', 'ForumComment.update')
                params.append('params[id]', comment.id)
                params.append('params[status]', comment.status ?? 0)
                handleRequest(params, '/api/update').then(response => {
                    showAlert(response.result)
                })
            }

            return {
                setCommentStatus,
                translate,
                emit,
                close
            }
        },
        props: [
            'path',
            'langs',
            'setting',
            'conf',
            'auth',
            'doctors',
            'categories',
            'item'
        ],
    };
</script>