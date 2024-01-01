<template>
    <div class=" w-full">

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-n4 mx-n4 card-border-effect-none mb-n5 border-bottom-0 border-start-0 rounded-0">
                        <div class="card-body pb-4 mb-0">
                            <div class="row">
                                <div class="col-md">
                                    <div class="row align-items-center">
                                        <div class="px-1 pt-1">
                                            <img v-if="item" :src="item.user ? item.user.photo : ''" alt="" width="36" height="36" class="rounded">
                                        </div>
                                        <!--end col-->
                                        <div class="col-md">
                                            <h4 class="fw-semibold" id="ticket-title" v-text="item.subject"></h4>
                                            <div class="hstack gap-3 flex" >
                                                <div class="text-muted"><i
                                                        class="ri-building-line align-bottom me-1"></i><span
                                                        id="ticket-client" v-text="item.user ? item.user.name : ''"></span></div>
                                                <div class="vr"></div>
                                                <div class="text-muted"><span v-text="__('Created at')"></span> : <span
                                                        class="fw-medium " id="create-date" v-text="item.date"></span></div>
                                                <div class="vr"></div>
                                                <div class="text-muted"><span v-text="__('Last update')"></span> : <span
                                                        class="fw-medium " id="update-date"
                                                        v-text="item.last_update"></span></div>
                                                <div class="vr"></div>
                                                <div class="badge rounded-pill bg-info fs-12" id="ticket-status"
                                                    v-if="item.status" v-text="item.status"></div>
                                                <div class="badge rounded-pill bg-danger fs-12" id="ticket-priority"
                                                    v-if="item.priority" v-text="item.priority"></div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <span class="w-auto py-2 px-4 cursor-pointer text-lg" @click="$emit('callback')"><vue-feather class="w-5" type="x-circle"></vue-feather></span>
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

            <div class="lg:flex gap-6">
                <div class="col-xxl-9 w-full">
                    <div class="card">
                        <div class="card-body p-4">
                            <h6 class="fw-semibold text-uppercase mb-3" v-text="__('Ticket Discripation')"></h6>
                            <p class="text-muted" v-text="item.message"></p>
                        </div>
                        <!--end card-body-->
                        <div class="card-body p-4">
                            <h5 class="card-title text-sm font-semibold mb-4" v-text="__('Comments')"></h5>

                            <div data-simplebar="init" style="max-height: 300px;" class="overflow-y-auto">
                                <div class="simplebar-wrapper" >
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" >
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content">
                                                <div class="simplebar-content" >
                                                    <div class="flex gap-2 mb-4" v-for="comment in item.comments">
                                                        <div class="flex-shrink-0" v-if="comment.user">
                                                            <img :src="comment.user.photo" alt=""
                                                                class="mt-2 avatar-xs rounded-circle">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3" v-if="comment.user">
                                                            <h5 class="fs-13 flex gap-2"><span v-text="comment.user.name"></span>
                                                                <small class="text-muted" v-text="comment.date"></small>
                                                            </h5>
                                                            <p class="text-muted" v-text="comment.comment"></p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="/api/create" method="POST" data-refresh="1" id="add-device-form" class="action my-2 rounded-lg  pb-2">
                                <input name="type" type="hidden" value="HelpMessageComment.create">
                                <input name="params[message_id]" type="hidden" :value="item.message_id">
                                
                                <input v-if="model_id && column && column.column_type == 'hidden'" :name="'params['+column.key+']'" type="hidden" v-model="column.default">
                                
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <label for="exampleFormControlTextarea1" class="form-label"
                                            v-text="__('WRITE_COMMENT')"></label>
                                        <textarea name="params[comment]" class="form-control bg-light border-light"
                                            id="exampleFormControlTextarea1" rows="3"
                                            placeholder="Enter comments"></textarea>
                                    </div>
                                    <div class="col-lg-12 text-end mt-4">
                                        <button type="submit" href="javascript:void(0);" class="btn btn-primary" v-text="__('Send')"></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="w-96">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0" v-text="__('Ticket Details')"></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless align-middle mb-0 w-full">
                                    <tbody>
                                        <tr>
                                            <td class="fw-medium py-2 " v-text="__('Ticket')"></td>
                                            <td class="py-2" >#<span id="t-no" v-text="item.message_id"></span> </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium py-2 " v-text="__('User')"></td>
                                            <td id="t-client" class="py-2" v-text="item.user ? item.user.name : ''"></td>
                                        </tr>

                                        <tr>
                                            <td class="fw-medium py-2 " v-text="__('Status')"></td>
                                            <td class="py-2" >
                                                <span class="font-bold" id="t-status" v-text="item.status"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium py-2 " v-text="__('Priority')"></td>
                                            <td class="py-2" >
                                                <span class="badge bg-danger" id="t-priority" v-text="item.priority"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium py-2" v-text="__('Created at')"></td>
                                            <td id="c-date" class="py-2" v-text="item.date"></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium py-2 " v-text="__('Last update')"></td>
                                            <td id="d-date" class="py-2" v-text="item.last_update"></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium py-2 " v-text="__('Close ticket')"></td>
                                            <td id="d-date" class="py-2 flex" >
                                                <vue-feather type="power"></vue-feather>
                                                <span @click="close" class="cursor-pointer hover:bg-red-800 hover:text-gray-100 px-3 py-2 text-sm border-red-600 border-1 rounded border mt-2 block text-center" id="t-close" v-text="__('Close')"></span>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
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
import {translate, handleGetRequest} from '@/utils.vue';

export default
    {

        props: [
            'path',
            'lang',
            'setting',
            'conf',
            'auth',
            'item'
        ],
        methods: {

            __(i) {
                return translate(i);
            },
            
            close() {
                
                if (!window.confirm(this.__('confirm_close_ticket')))
                {
                    return null;
                }

                var params = new URLSearchParams();
                params.append('type', 'HelpMessage.close')
                params.append('params[message_id]', this.item.message_id)
                params.append('params[status]', 'completed')
                handleRequest(params, '/api/handle').then(response => {
                    this.$alert(response.result)
                })
            },

        }
    };
</script>