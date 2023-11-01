<template>
    <div class=" w-full">
        <div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
            <h4 class="mb-sm-0">Project List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                    <li class="breadcrumb-item active">Project List</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row g-4 mb-3">
    <div class="col-sm-auto">
        <div>
            <a href="apps-projects-create.html" class="btn btn-primary"><i class="ri-add-line align-bottom me-1"></i> Add New</a>
        </div>
    </div>
    <div class="col-sm">
        <div class="d-flex justify-content-sm-end gap-2">
            <div class="search-box ms-2">
                <input type="text" class="form-control" placeholder="Search...">
                <i class="ri-search-line search-icon"></i>
            </div>

            <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control w-md choices__input" data-choices="" data-choices-search-false="" hidden="" tabindex="-1" data-choice="active"><option value="Yesterday" data-custom-properties="[object Object]">Yesterday</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="Yesterday" data-custom-properties="[object Object]" aria-selected="true">Yesterday</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--nvl1-item-choice-1" class="choices__item choices__item--choice choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="All" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">All</div><div id="choices--nvl1-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Last 7 Days" data-select-text="Press to select" data-choice-selectable="">Last 7 Days</div><div id="choices--nvl1-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Last 30 Days" data-select-text="Press to select" data-choice-selectable="">Last 30 Days</div><div id="choices--nvl1-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Last Year" data-select-text="Press to select" data-choice-selectable="">Last Year</div><div id="choices--nvl1-item-choice-5" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="5" data-value="This Month" data-select-text="Press to select" data-choice-selectable="">This Month</div><div id="choices--nvl1-item-choice-6" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="6" data-value="Today" data-select-text="Press to select" data-choice-selectable="">Today</div><div id="choices--nvl1-item-choice-7" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="7" data-value="Yesterday" data-select-text="Press to select" data-choice-selectable="">Yesterday</div></div></div></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card card-height-100">
            <div class="card-body">
                <div class="d-flex flex-column h-100">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-4">Updated 3hrs ago</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex gap-1 align-items-center">
                                <button type="button" class="btn avatar-xs mt-n1 p-0 favourite-btn">
                                    <span class="avatar-title bg-transparent fs-15">
                                        <i class="ri-star-fill"></i>
                                    </span>
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1 mt-n2 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                        <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm">
                                <span class="avatar-title bg-warning-subtle rounded p-2">
                                    <img src="assets/images/brands/slack.png" alt="" class="img-fluid p-1">
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 fs-15"><a href="apps-projects-overview.html" class="text-body">Slack brand logo design</a></h5>
                            <p class="text-muted text-truncate-two-lines mb-3">Create a Brand logo design for a velzon admin.</p>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <div class="d-flex mb-2">
                            <div class="flex-grow-1">
                                <div>Tasks</div>
                            </div>
                            <div class="flex-shrink-0">
                                <div><i class="ri-list-check align-bottom me-1 text-muted"></i> 18/42</div>
                            </div>
                        </div>
                        <div class="progress progress-sm animated-progress">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width: 34%;"></div><!-- /.progress-bar -->
                        </div><!-- /.progress -->
                    </div>
                </div>

            </div>
            <!-- end card body -->
            <div class="card-footer bg-transparent border-top-dashed py-2">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Darline Williams" data-bs-original-title="Darline Williams">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="text-muted">
                            <i class="ri-calendar-event-fill me-1 align-bottom"></i> 10 Jul, 2021
                        </div>
                    </div>

                </div>

            </div>
            <!-- end card footer -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card card-height-100">
            <div class="card-body">
                <div class="d-flex flex-column h-100">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-4">Last update : 08 May</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex gap-1 align-items-center">
                                <button type="button" class="btn avatar-xs mt-n1 p-0 favourite-btn active">
                                    <span class="avatar-title bg-transparent fs-15">
                                        <i class="ri-star-fill"></i>
                                    </span>
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1 mt-n2 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                        <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm">
                                <span class="avatar-title bg-danger-subtle rounded p-2">
                                    <img src="assets/images/brands/dribbble.png" alt="" class="img-fluid p-1">
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 fs-15"><a href="apps-projects-overview.html" class="text-body">Redesign - Landing page</a></h5>
                            <p class="text-muted text-truncate-two-lines mb-3">Resign a landing page design. as per abc minimal design.</p>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <div class="d-flex mb-2">
                            <div class="flex-grow-1">
                                <div>Tasks</div>
                            </div>
                            <div class="flex-shrink-0">
                                <div><i class="ri-list-check align-bottom me-1 text-muted"></i> 22/56</div>
                            </div>
                        </div>
                        <div class="progress progress-sm animated-progress">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div><!-- /.progress-bar -->
                        </div><!-- /.progress -->
                    </div>
                </div>

            </div>
            <!-- end card body -->
            <div class="card-footer bg-transparent border-top-dashed py-2">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Brent Gonzalez" data-bs-original-title="Brent Gonzalez">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Sylvia Wright">
                                <div class="avatar-xxs">
                                    <div class="avatar-title rounded-circle bg-secondary">
                                        S
                                    </div>
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Ellen Smith" data-bs-original-title="Ellen Smith">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="text-muted">
                            <i class="ri-calendar-event-fill me-1 align-bottom"></i> 18 May, 2021
                        </div>
                    </div>

                </div>

            </div>
            <!-- end card footer -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card card-height-100">
            <div class="card-body">
                <div class="d-flex flex-column h-100">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-4">Updated 2hrs ago</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex gap-1 align-items-center">
                                <button type="button" class="btn avatar-xs mt-n1 p-0 favourite-btn active">
                                    <span class="avatar-title bg-transparent fs-15">
                                        <i class="ri-star-fill"></i>
                                    </span>
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1 mt-n2 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                        <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm">
                                <span class="avatar-title bg-success-subtle rounded p-2">
                                    <img src="assets/images/brands/mail_chimp.png" alt="" class="img-fluid p-1">
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 fs-15"><a href="apps-projects-overview.html" class="text-body">Chat Application</a></h5>
                            <p class="text-muted text-truncate-two-lines mb-3">Create a Chat application for business messaging needs. Collaborate efficiently with secure direct messages and group chats.</p>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <div class="d-flex mb-2">
                            <div class="flex-grow-1">
                                <div>Tasks</div>
                            </div>
                            <div class="flex-shrink-0">
                                <div><i class="ri-list-check align-bottom me-1 text-muted"></i> 14/20</div>
                            </div>
                        </div>
                        <div class="progress progress-sm animated-progress">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%;"></div><!-- /.progress-bar -->
                        </div><!-- /.progress -->
                    </div>
                </div>

            </div>
            <!-- end card body -->
            <div class="card-footer bg-transparent border-top-dashed py-2">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Jeffrey Salazar" data-bs-original-title="Jeffrey Salazar">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Mark Williams">
                                <div class="avatar-xxs">
                                    <div class="avatar-title rounded-circle bg-warning">
                                        M
                                    </div>
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="text-muted">
                            <i class="ri-calendar-event-fill me-1 align-bottom"></i> 21 Feb, 2021
                        </div>
                    </div>

                </div>

            </div>
            <!-- end card footer -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card card-height-100">
            <div class="card-body">
                <div class="d-flex flex-column h-100">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-4">Last update : 21 Jun</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex gap-1 align-items-center">
                                <button type="button" class="btn avatar-xs mt-n1 p-0 favourite-btn">
                                    <span class="avatar-title bg-transparent fs-15">
                                        <i class="ri-star-fill"></i>
                                    </span>
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1 mt-n2 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                        <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm">
                                <span class="avatar-title bg-info-subtle rounded p-2">
                                    <img src="assets/images/brands/dropbox.png" alt="" class="img-fluid p-1">
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 fs-15"><a href="apps-projects-overview.html" class="text-body">Project App</a></h5>
                            <p class="text-muted text-truncate-two-lines mb-3">Create a project application for a project management and task management.</p>
                        </div>
                    </div>

                    <div class="mt-auto">
                        <div class="d-flex mb-2">
                            <div class="flex-grow-1">
                                <div>Tasks</div>
                            </div>
                            <div class="flex-shrink-0">
                                <div><i class="ri-list-check align-bottom me-1 text-muted"></i> 20/34</div>
                            </div>
                        </div>
                        <div class="progress progress-sm animated-progress">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%;"></div><!-- /.progress-bar -->
                        </div><!-- /.progress -->
                    </div>
                </div>

            </div>
            <!-- end card body -->
            <div class="card-footer bg-transparent border-top-dashed py-2">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Kristin Turpin">
                                <div class="avatar-xxs">
                                    <div class="avatar-title rounded-circle bg-info">
                                        K
                                    </div>
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Mary Leavitt">
                                <div class="avatar-xxs">
                                    <div class="avatar-title rounded-circle bg-danger">
                                        M
                                    </div>
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="text-muted">
                            <i class="ri-calendar-event-fill me-1 align-bottom"></i> 03 Aug, 2021
                        </div>
                    </div>

                </div>

            </div>
            <!-- end card footer -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card">
            <div class="card-body">
                <div class="p-3 mt-n3 mx-n3 bg-danger-subtle rounded-top">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fs-14"><a href="apps-projects-overview.html" class="text-body">Multipurpose landing template</a></h5>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex gap-1 align-items-center my-n2">
                                <button type="button" class="btn avatar-xs p-0 favourite-btn active">
                                    <span class="avatar-title bg-transparent fs-15">
                                        <i class="ri-star-fill"></i>
                                    </span>
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                        <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-3">
                    <div class="row gy-3">
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Status</p>
                                <div class="badge bg-warning-subtle text-warning fs-12">Inprogress</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Deadline</p>
                                <h5 class="fs-14">18 Sep, 2021</h5>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-3">
                        <p class="text-muted mb-0 me-2">Team :</p>
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Donna Kline">
                                <div class="avatar-xxs">
                                    <div class="avatar-title rounded-circle bg-danger">
                                        D
                                    </div>
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Lee Winton" data-bs-original-title="Lee Winton">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Johnny Shorter" data-bs-original-title="Johnny Shorter">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <div>Progress</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div>50%</div>
                        </div>
                    </div>
                    <div class="progress progress-sm animated-progress">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                        </div><!-- /.progress-bar -->
                    </div><!-- /.progress -->
                </div>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card">
            <div class="card-body">
                <div class="p-3 mt-n3 mx-n3 bg-warning-subtle rounded-top">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fs-14"><a href="apps-projects-overview.html" class="text-body">Dashboard UI</a></h5>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex gap-1 align-items-center my-n2">
                                <button type="button" class="btn avatar-xs p-0 favourite-btn active">
                                    <span class="avatar-title bg-transparent fs-15">
                                        <i class="ri-star-fill"></i>
                                    </span>
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                        <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-3">
                    <div class="row gy-3">
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Status</p>
                                <div class="badge bg-success-subtle text-success fs-12">Completed</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Deadline</p>
                                <h5 class="fs-14"> 10 Jun, 2021</h5>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-3">
                        <p class="text-muted mb-0 me-2">Team :</p>
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Bonnie Haynes" data-bs-original-title="Bonnie Haynes">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Della Wilson" data-bs-original-title="Della Wilson">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <div>Progress</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div>95%</div>
                        </div>
                    </div>
                    <div class="progress progress-sm animated-progress">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;"></div><!-- /.progress-bar -->
                    </div><!-- /.progress -->
                </div>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card">
            <div class="card-body">
                <div class="p-3 mt-n3 mx-n3 bg-info-subtle rounded-top">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fs-14"><a href="apps-projects-overview.html" class="text-body">Vector Images</a></h5>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex gap-1 align-items-center my-n2">
                                <button type="button" class="btn avatar-xs p-0 favourite-btn">
                                    <span class="avatar-title bg-transparent fs-15">
                                        <i class="ri-star-fill"></i>
                                    </span>
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                        <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-3">
                    <div class="row gy-3">
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Status</p>
                                <div class="badge bg-warning-subtle text-warning fs-12">Inprogress</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Deadline</p>
                                <h5 class="fs-14">08 Apr, 2021</h5>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-3">
                        <p class="text-muted mb-0 me-2">Team :</p>
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Chet Diaz">
                                <div class="avatar-xxs">
                                    <div class="avatar-title rounded-circle bg-info">
                                        C
                                    </div>
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <div>Progress</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div>41%</div>
                        </div>
                    </div>
                    <div class="progress progress-sm animated-progress">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100" style="width: 41%;"></div><!-- /.progress-bar -->
                    </div><!-- /.progress -->
                </div>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card">
            <div class="card-body">
                <div class="p-3 mt-n3 mx-n3 bg-success-subtle rounded-top">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fs-14"><a href="apps-projects-overview.html" class="text-body">Authentication</a></h5>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex gap-1 align-items-center my-n2">
                                <button type="button" class="btn avatar-xs p-0 favourite-btn active">
                                    <span class="avatar-title bg-transparent fs-15">
                                        <i class="ri-star-fill"></i>
                                    </span>
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                        <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-3">
                    <div class="row gy-3">
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Status</p>
                                <div class="badge bg-warning-subtle text-warning fs-12">Inprogress</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Deadline</p>
                                <h5 class="fs-14">22 Nov, 2021</h5>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-3">
                        <p class="text-muted mb-0 me-2">Team :</p>
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Virginia Wall" data-bs-original-title="Virginia Wall">
                                <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle avatar-xxs">
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <div>Progress</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div>35%</div>
                        </div>
                    </div>
                    <div class="progress progress-sm animated-progress">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%;"></div><!-- /.progress-bar -->
                    </div><!-- /.progress -->
                </div>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->


<div class="row">
    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card">
            <div class="card-body">
                <div class="p-3 mt-n3 mx-n3 bg-secondary-subtle rounded-top">
                    <div class="d-flex gap-1 align-items-center justify-content-end my-n2">
                        <button type="button" class="btn avatar-xs p-0 favourite-btn active">
                            <span class="avatar-title bg-transparent fs-15">
                                <i class="ri-star-fill"></i>
                            </span>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pb-3">
                        <img src="assets/images/brands/dribbble.png" alt="" height="32">
                    </div>
                </div>

                <div class="py-3">
                    <h5 class="fs-14 mb-3"><a href="apps-projects-overview.html" class="text-body">Kanban Board</a></h5>
                    <div class="row gy-3">
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Status</p>
                                <div class="badge bg-warning-subtle text-warning fs-12">Inprogress</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Deadline</p>
                                <h5 class="fs-14">08 Dec, 2021</h5>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-3">
                        <p class="text-muted mb-0 me-2">Team :</p>
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Terry Moberly">
                                <div class="avatar-xxs">
                                    <div class="avatar-title rounded-circle bg-danger">
                                        T
                                    </div>
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Ruby Miller" data-bs-original-title="Ruby Miller">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <div>Tasks</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div><i class="ri-list-check align-bottom me-1 text-muted"></i> 17/20 </div>
                        </div>
                    </div>
                    <div class="progress progress-sm animated-progress">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: 71%;"></div><!-- /.progress-bar -->
                    </div><!-- /.progress -->
                </div>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card">
            <div class="card-body">
                <div class="p-3 mt-n3 mx-n3 bg-light rounded-top">
                    <div class="d-flex gap-1 align-items-center justify-content-end my-n2">
                        <button type="button" class="btn avatar-xs p-0 favourite-btn">
                            <span class="avatar-title bg-transparent fs-15">
                                <i class="ri-star-fill"></i>
                            </span>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pb-3">
                        <img src="assets/images/brands/slack.png" alt="" height="32">
                    </div>
                </div>
                <div class="py-3">
                    <h5 class="mb-3 fs-14"><a href="apps-projects-overview.html" class="text-body">Ecommerce app</a></h5>
                    <div class="row gy-3">
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Status</p>
                                <div class="badge bg-warning-subtle text-warning fs-12">Inprogress</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Deadline</p>
                                <h5 class="fs-14">20 Nov, 2021</h5>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-3">
                        <p class="text-muted mb-0 me-2">Team :</p>
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Irma Metz" data-bs-original-title="Irma Metz">
                                <img src="assets/images/users/avatar-9.jpg" alt="" class="rounded-circle avatar-xxs">
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="James Clem" data-bs-original-title="James Clem">
                                <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-xxs">
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <div>Tasks</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div>
                                <i class="ri-list-check align-bottom me-1 text-muted"></i> 11/45
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm animated-progress">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div><!-- /.progress-bar -->
                    </div><!-- /.progress -->
                </div>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card">
            <div class="card-body">
                <div class="p-3 mt-n3 mx-n3 bg-primary-subtle rounded-top">
                    <div class="d-flex gap-1 align-items-center justify-content-end my-n2">
                        <button type="button" class="btn avatar-xs p-0 favourite-btn">
                            <span class="avatar-title bg-transparent fs-15">
                                <i class="ri-star-fill"></i>
                            </span>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pb-3">
                        <img src="assets/images/brands/dropbox.png" alt="" height="32">
                    </div>
                </div>

                <div class="py-3">
                    <h5 class="mb-3 fs-14"><a href="apps-projects-overview.html" class="text-body">Redesign - Landing page</a></h5>
                    <div class="row gy-3">
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Status</p>
                                <div class="badge bg-warning-subtle text-warning fs-12">Inprogress</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Deadline</p>
                                <h5 class="fs-14">10 Jul, 2021</h5>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-3">
                        <p class="text-muted mb-0 me-2">Team :</p>
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Brent Gonzalez" data-bs-original-title="Brent Gonzalez">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Sylvia Wright">
                                <div class="avatar-xxs">
                                    <div class="avatar-title rounded-circle bg-secondary">
                                        S
                                    </div>
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Ellen Smith" data-bs-original-title="Ellen Smith">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <div>Tasks</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div>
                                <i class="ri-list-check align-bottom me-1 text-muted"></i> 13/26
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm animated-progress">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div><!-- /.progress-bar -->
                    </div><!-- /.progress -->
                </div>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xxl-3 col-sm-6 project-card">
        <div class="card">
            <div class="card-body">
                <div class="p-3 mt-n3 mx-n3 bg-danger-subtle rounded-top">
                    <div class="d-flex gap-1 align-items-center justify-content-end my-n2">
                        <button type="button" class="btn avatar-xs p-0 favourite-btn active">
                            <span class="avatar-title bg-transparent fs-15">
                                <i class="ri-star-fill"></i>
                            </span>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="apps-projects-overview.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                <a class="dropdown-item" href="apps-projects-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pb-3">
                        <img src="assets/images/brands/mail_chimp.png" alt="" height="32">
                    </div>
                </div>

                <div class="py-3">
                    <h5 class="mb-3 fs-14"><a href="apps-projects-overview.html" class="text-body">Multipurpose landing template</a></h5>
                    <div class="row gy-3">
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Status</p>
                                <div class="badge bg-success-subtle text-success fs-12">Completed</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="text-muted mb-1">Deadline</p>
                                <h5 class="fs-14">18 Sep, 2021</h5>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-3">
                        <p class="text-muted mb-0 me-2">Team :</p>
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Donna Kline">
                                <div class="avatar-xxs">
                                    <div class="avatar-title rounded-circle bg-danger">
                                        D
                                    </div>
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Lee Winton" data-bs-original-title="Lee Winton">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Johnny Shorter" data-bs-original-title="Johnny Shorter">
                                <div class="avatar-xxs">
                                    <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle img-fluid">
                                </div>
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                <div class="avatar-xxs">
                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <div>Tasks</div>
                        </div>
                        <div class="flex-shrink-0">
                            <div>
                                <i class="ri-list-check align-bottom me-1 text-muted"></i> 25/32
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm animated-progress">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div><!-- /.progress-bar -->
                    </div><!-- /.progress -->
                </div>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row g-0 text-center text-sm-start align-items-center mb-4">
    <div class="col-sm-6">
        <div>
            <p class="mb-sm-0 text-muted">Showing <span class="fw-semibold">1</span> to <span class="fw-semibold">10</span> of <span class="fw-semibold text-decoration-underline">12</span> entries</p>
        </div>
    </div>
    <!-- end col -->
    <div class="col-sm-6">
        <ul class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
            <li class="page-item disabled">
                <a href="#" class="page-link">Previous</a>
            </li>
            <li class="page-item active">
                <a href="#" class="page-link">1</a>
            </li>
            <li class="page-item ">
                <a href="#" class="page-link">2</a>
            </li>
            <li class="page-item">
                <a href="#" class="page-link">3</a>
            </li>
            <li class="page-item">
                <a href="#" class="page-link">4</a>
            </li>
            <li class="page-item">
                <a href="#" class="page-link">5</a>
            </li>
            <li class="page-item">
                <a href="#" class="page-link">Next</a>
            </li>
        </ul>
    </div><!-- end col -->
</div><!-- end row -->
</div>
        <data_table_page ref="data_table"  :conf="conf" :path="path" :setting="setting" :auth="auth" object_name="HelpMessage" object_key="message_id" ></data_table_page>
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
    ],
    methods: {
        
    }
};
</script>