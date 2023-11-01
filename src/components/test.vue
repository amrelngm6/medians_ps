<template>
    <div class=" w-full">

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-n4 mx-n4 card-border-effect-none mb-n5 border-bottom-0 border-start-0 rounded-0">
                        <div class="card-body pb-4 mb-5">
                            <div class="row">
                                <div class="col-md">
                                    <div class="row align-items-center">
                                        <div class="col-md-auto">
                                            <img v-if="item" :src="item.user.picture" alt="" width="28" height="28" class="rounded">
                                        </div>
                                        <!--end col-->
                                        <div class="col-md">
                                            <h4 class="fw-semibold" id="ticket-title" v-text="item.subject"></h4>
                                            <div class="hstack gap-3 flex">
                                                <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i><span id="ticket-client" v-text="item.user.name"></span></div>
                                                <div class="vr"></div>
                                                <div class="text-muted"><span v-text="__('Created at')"></span> : <span class="fw-medium " id="create-date" v-text="item.date"></span></div>
                                                <div class="vr"></div>
                                                <div class="text-muted"><span v-text="__('Last update')"></span> : <span class="fw-medium " id="update-date" v-text="item.last_update"></span></div>
                                                <div class="vr"></div>
                                                <div class="badge rounded-pill bg-info fs-12" id="ticket-status"  v-if="item.status" v-text="item.status"></div>
                                                <div class="badge rounded-pill bg-danger fs-12" id="ticket-priority" v-if="item.priority" v-text="item.priority"></div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end col-->
                                <div class="col-md-auto mt-md-0 mt-4">
                                    <div class="hstack gap-1 flex-wrap">
                                        <button @click="showI = false,showoptions = !showoptions, showI = true" type="button" class="btn py-0 fs-16 text-body" id="settingDropdown" data-bs-toggle="dropdown">
                                            <i class="fa fa-ellipsis"></i>
                                        </button>
                                        <ul v-if="showI && showoptions" class="dropdown-menu" aria-labelledby="settingDropdown">
                                            <li><a class="dropdown-item" href="#"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-share-forward-fill align-bottom me-2 text-muted"></i> Share with</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                        </ul>
                                    </div>
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
                            <h5 class="card-title mb-4">Comments</h5>

                            <div data-simplebar="init" style="max-height: 300px;" class="px-3 mx-n3 overflow-y-auto"><div class="simplebar-wrapper" style="margin: 0px -16px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" ><div class="simplebar-content" style="padding: 0px 16px;">
                                <div class="d-flex mb-4" v-for="comment in item.comments">
                                    <div class="flex-shrink-0" v-if="comment.user">
                                        <img :src="comment.user.picture" alt="" class="avatar-xs rounded-circle">
                                    </div>
                                    <div class="flex-grow-1 ms-3" v-if="comment.user">
                                        <h5 class="fs-13"><span v-text="comment.user.name"></span> <small class="text-muted" v-text="comment.time"></small></h5>
                                        <p class="text-muted" v-text="comment.comment"></p>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <form action="javascript:void(0);" class="mt-3">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="exampleFormControlTextarea1" class="form-label" v-text="__('WRITE_COMMENT')"></label>
                            <textarea class="form-control bg-light border-light" id="exampleFormControlTextarea1" rows="3" placeholder="Enter comments"></textarea>
                        </div>
                        <div class="col-lg-12 text-end mt-4">
                            <a href="javascript:void(0);" class="btn btn-primary" v-text="__('Comments')"></a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div> 
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-3 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0" v-text="__('Ticket Details')"></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-borderless align-middle mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-medium" v-text="__('Ticket')"></td>
                                <td>#<span id="t-no" v-text="item.message_id"></span> </td>
                            </tr>
                            <tr>
                                <td class="fw-medium" v-text="__('User')"></td>
                                <td id="t-client" v-text="item.user.name"></td>
                            </tr>

                            <tr>
                                <td class="fw-medium" v-text="__('Status')"></td>
                                <td>
                                    <span class="font-bold" id="t-status" v-text="item.status"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-medium"  v-text="__('Priority')"></td>
                                <td>
                                    <span class="badge bg-danger" id="t-priority" v-text="item.priority"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-medium" v-text="__('Created at')"></td>
                                <td id="c-date" v-text="item.date"></td>
                            </tr>
                            <tr>
                                <td class="fw-medium" v-text="__('Last update')"></td>
                                <td id="d-date" v-text="item.last_update"></td>
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
        
        __(i)
        {
            return this.$root.$children[0].__(i);
        }
    }
};
</script>