<template>
    <div class=" w-full">

        <div class="container-fluid">

<div class="row">
    <div class="col-lg-12">
        <div class="card mt-n4 mx-n4 card-border-effect-none mb-n5 border-bottom-0 border-start-0 rounded-0">
            <div>
                <div class="card-body pb-4 mb-5">
                    <div class="row">
                        <div class="col-md">
                            <div class="row align-items-center">
                                <div class="col-md-auto">
                                    <div class="avatar-md mb-md-0 mb-4">
                                        <div class="avatar-title bg-white rounded-circle">
                                            <img v-if="item" :src="item.user.picture" alt="" class="avatar-sm">
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md">
                                    <h4 class="fw-semibold" id="ticket-title" v-text="item.subject"></h4>
                                    <div class="hstack gap-3 flex">
                                        <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i><span id="ticket-client" v-text="item.user.name"></span></div>
                                        <div class="vr"></div>
                                        <div class="text-muted"><span v-text="__('Created at')"></span> <span class="fw-medium " id="create-date" v-text="item.created_at"></span></div>
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
                </div><!-- end card body -->
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

<div class="lg:flex gap-6">
    <div class="col-xxl-9 ">
        <div class="card">
            <div class="card-body p-4">
                <h6 class="fw-semibold text-uppercase mb-3" v-text="__('Ticket Discripation')"></h6>
                <p class="text-muted" v-text="item.message"></p>
                
            </div>
            <!--end card-body-->
            <div class="card-body p-4">
                <h5 class="card-title mb-4">Comments</h5>

                <div data-simplebar="init" style="max-height: 300px;" class="px-3 mx-n3 overflow-y-auto"><div class="simplebar-wrapper" style="margin: 0px -16px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" ><div class="simplebar-content" style="padding: 0px 16px;">
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <img src="assets/images/users/avatar-8.jpg" alt="" class="avatar-xs rounded-circle">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fs-13">Joseph Parker <small class="text-muted">20 Dec 2021 - 05:47AM</small></h5>
                            <p class="text-muted">I am getting message from customers that when they place order always get error message .</p>
                            <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                            <div class="d-flex mt-4">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xs rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fs-13">Alexis Clarke <small class="text-muted">22 Dec 2021 - 02:32PM</small></h5>
                                    <p class="text-muted">Please be sure to check your Spam mailbox to see if your email filters have identified the email from Dell as spam.</p>
                                    <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fs-13">Donald Palmer <small class="text-muted">24 Dec 2021 - 05:20PM</small></h5>
                            <p class="text-muted">If you have further questions, please contact Customer Support from the “Action Menu” on your <a href="javascript:void(0);" class="text-decoration-underline">Online Order Support</a>.</p>
                            <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-xs rounded-circle">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fs-13">Alexis Clarke <small class="text-muted">26 min ago</small></h5>
                            <p class="text-muted">Your <a href="javascript:void(0)" class="text-decoration-underline">Online Order Support</a> provides you with the most current status of your order. To help manage your order refer to the “Action Menu” to initiate return, contact Customer Support and more.</p>
                            <div class="row g-2 mb-3">
                                <div class="col-lg-1 col-sm-2 col-6">
                                    <img src="assets/images/small/img-4.jpg" alt="" class="img-fluid rounded">
                                </div>
                                <div class="col-lg-1 col-sm-2 col-6">
                                    <img src="assets/images/small/img-5.jpg" alt="" class="img-fluid rounded">
                                </div>
                            </div>
                            <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                            <div class="d-flex mt-4">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fs-13">Donald Palmer <small class="text-muted">8 sec ago</small></h5>
                                    <p class="text-muted">Other shipping methods are available at checkout if you want your purchase delivered faster.</p>
                                    <a href="javascript: void(0);" class="badge text-muted bg-light"><i class="mdi mdi-reply"></i> Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></div></div></div>
            </div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div>
        </div>
                <form action="javascript:void(0);" class="mt-3">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Leave a Comments</label>
                            <textarea class="form-control bg-light border-light" id="exampleFormControlTextarea1" rows="3" placeholder="Enter comments"></textarea>
                        </div>
                        <div class="col-lg-12 text-end mt-4">
                            <a href="javascript:void(0);" class="btn btn-primary">Post Comments</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-3 w-full">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Ticket Details</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-borderless align-middle mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-medium">Ticket</td>
                                <td>#VLZ<span id="t-no">135</span> </td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Client</td>
                                <td id="t-client">Themesbrand</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Project</td>
                                <td>Velzon - Admin Dashboard</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Assigned To:</td>
                                <td>
                                    <div class="avatar-group">
                                        <a href="javascript:void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="Erica Kernan">
                                            <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="Alexis Clarke">
                                            <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="James Price">
                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xs">
                                        </a>
                                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                            <div class="avatar-xs">
                                                <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-white">
                                                    +
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-medium" v-text="__('Status')"></td>
                                <td>
                                    <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-select choices__input" id="t-status" data-choices="" data-choices-search-false="" aria-label="Default select example" hidden="" tabindex="-1" data-choice="active"><option value="New" data-custom-properties="[object Object]">New</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="New" data-custom-properties="[object Object]" aria-selected="true">New</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--t-status-item-choice-5" class="choices__item choices__item--choice choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="5" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Status</div><div id="choices--t-status-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Closed" data-select-text="Press to select" data-choice-selectable="">Closed</div><div id="choices--t-status-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Inprogress" data-select-text="Press to select" data-choice-selectable="">Inprogress</div><div id="choices--t-status-item-choice-3" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="3" data-value="New" data-select-text="Press to select" data-choice-selectable="">New</div><div id="choices--t-status-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Open" data-select-text="Press to select" data-choice-selectable="">Open</div></div></div></div>
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
                                <td id="d-date" v-text="item.updated_at"></td>
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