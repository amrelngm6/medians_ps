<template>
    <div class="w-full ">
        
        <div v-if="loading" :key="loading" class="bg-white fixed w-full h-full top-0 left-0" style="z-index:99999; opacity: .9;">
            <img class="m-auto w-500px" :src="'/uploads/loader.gif'" />
        </div>
        <div class="w-full flex overflow-auto">
            <div class=" w-full relative">
                <close_icon class="absolute top-4 right-4 z-10 cursor-pointer" @click="back" />
                <div class=" card w-full py-10">
                    <div class="w-full stepper stepper-links ">
                        <div class="stepper-nav justify-content-center py-2 mb-10">
                            <div class="stepper-item " v-for="row in fillable" @click="activeTab = row">
                                <h3 :class="activeTab == row ? 'text-danger border-danger' : 'text-gray-400 border-transparent'"
                                    class="cursor-pointer pb-3 px-2 stepper-title text-md border-b " v-text="translate(row)"></h3>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="" v-if="activeTab == usertype" :key="activeTab">
                                <div class="card-body pt-0 mx-auto max-w-xl" :key="users">
                                    <div class="text-center mb-13">
                                        <h1 class="mb-3" v-text="translate('Find')+' '+translate(usertype)"></h1>

                                        <div class="text-gray-400 font-semibold "
                                            v-text="translate('Search by name or mobile')"></div>
                                    </div>
                                    <div class="w-100 relative mb-5" autocomplete="off">

                                        <vue-feather type="smile"
                                            class="text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></vue-feather>

                                        <input type="text" @type="findUser" @input="findUser" v-model="searchText"
                                            class="form-control form-control-lg form-control-solid px-15"
                                            :placeholder="translate('Search by name or mobile')">
                                    </div>
                                    <div class="w-full " v-for="usermodel in userslist" v-if="searchText">
                                        <a href="javascript:;" :key="usermodel.show" v-if="usermodel.show"
                                            class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                            <div class="symbol symbol-35px symbol-circle me-5"><img alt="Pic"
                                                    :src="usermodel.picture"></div>
                                            <div class="fw-semibold w-full">
                                                <span class="text-lg text-danger font-semibold me-2"
                                                    v-text="usermodel.name"></span>
                                                <span class="block text-gray-500 text-sm"
                                                    v-text="usermodel.mobile"></span>
                                            </div>
                                            <span @click="setUser(usermodel)" class="btn btn-danger btn-sm text-white"
                                                v-text="translate('Choose')"></span>
                                        </a>
                                    </div>
                                    <a href="javascript:;" :key="activeItem.model" v-if="activeItem.model"
                                        class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                        <div class="symbol symbol-35px symbol-circle me-5"><img alt="Pic"
                                                :src="activeItem.model.picture"></div>
                                        <div class="fw-semibold w-full">
                                            <span class="text-lg text-danger font-semibold me-2"
                                                v-text="activeItem.model.name"></span>
                                            <span class="block text-gray-500 text-sm"
                                                v-text="activeItem.model.mobile"></span>
                                        </div>
                                    </a>
                                </div>
                                <p class="text-center"><a href="javascript:;"
                                        class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                        @click="activeTab = 'Pickup location'" v-text="translate('Pickup location')"></a></p>
                            </div>

                            <div class="" v-if="activeTab == 'Pickup location'" :key="activeTab">
                                <div class="card-body pt-0">
                                    <div class="settings-form">
                                        <div class="px-10 mb-6 mx-auto row">
                                            <div class="lg:flex w-full ">
                                                <div class="mt-10 w-full">
                                                    <h3 class="mb-3" v-text="translate('Location Address')"></h3>

                                                    <div class="fw-semibold text-gray-600 fs-6">
                                                        <span class="d-block fw-bold pb-3 text-gray-400"
                                                            :key="activeItem.pickup_address"
                                                            v-text="activeItem.pickup_address"></span>
                                                        <a class="fw-bold" @click="showPlaceSearch = true" href="javascript:;"
                                                            v-text="translate('Change')"></a>
                                                    </div>
                                                    <div v-if="showPlaceSearch" :key="showPlaceSearch">
                                                        <input autocomplete="off" @change="pickupPlaceChanged"
                                                            v-model="pickup_placeSearch" type="text"
                                                            class="form-control form-control-solid"
                                                            :placeholder="translate('Find Location')">

                                                        <div class="mt-3 w-full card-body" v-if="places" :key="places">
                                                            <div class="w-full" v-for="place in places">
                                                                <div class="d-flex align-items-center mb-8" v-if="place">
                                                                    <span
                                                                        class="bullet bullet-vertical h-40px bg-success"></span>
                                                                    <div class="form-check form-check-custom form-check-solid mx-5 cursor-pointer"
                                                                        @click="setPlaceMarker(place, 'pickup')">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="">
                                                                    </div>
                                                                    <div class="flex-grow-1 cursor-pointer"
                                                                        @click="setPlaceMarker(place, 'pickup')">
                                                                        <a href="#"
                                                                            class="text-gray-800 text-hover-primary fw-bold fs-6"
                                                                            v-if="place.structured_formatting"
                                                                            v-text="place.structured_formatting.main_text"></a>
                                                                        <span class="text-muted fw-semibold d-block"
                                                                            v-text="place.description"></span>
                                                                    </div>
                                                                    <span class="badge badge-light-success fs-8 fw-bold"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" w-full">
                                                    <editable_map_location :system_setting="system_setting" :item="activeItem"
                                                        @setlocation="updatePickupMarker" :key="activeItem.pickup_latitude"
                                                        :location="{ lat: activeItem.pickup_latitude, lng: activeItem.pickup_longitude }">
                                                    </editable_map_location>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center"><a href="javascript:;"
                                    class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                    @click="activeTab = 'Destination'" v-text="translate('Destination')"></a></p>
                            </div>

                            <div class="" v-if="activeTab == 'Destination'" :key="activeTab">
                                <div class="card-body pt-0">
                                    <div class="px-10 mb-6 mx-auto row">
                                        <div class="lg:flex w-full">
                                            <div class="mt-10 w-full">
                                                <h3 class="mb-3" v-text="translate('Location Address')"></h3>

                                                <div class="fw-semibold text-gray-600 fs-6">
                                                    <span class="d-block fw-bold pb-3 text-gray-400"
                                                        :key="activeItem.destination_address" v-text="activeItem.destination_address"></span>
                                                    <a class="fw-bold" @click="showPlaceSearch = true" href="javascript:;"
                                                        v-text="translate('Change')"></a>
                                                </div>
                                                <div v-if="showPlaceSearch" :key="showPlaceSearch">
                                                    <input autocomplete="off" @change="destinationPlaceChanged"
                                                        v-model="destination_placeSearch" type="text"
                                                        class="form-control form-control-solid"
                                                        :placeholder="translate('Find Location')">

                                                    <div class="mt-3 w-full card-body" v-if="places && destination_placeSearch.length"
                                                        :key="places">
                                                        <div class="w-full" v-for="place in places">
                                                            <div class="d-flex align-items-center mb-8" v-if="place">
                                                                <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                                <div class="form-check form-check-custom form-check-solid mx-5 cursor-pointer"
                                                                    @click="setPlaceMarker(place, 'destination')">
                                                                    <input class="form-check-input" type="checkbox" value="">
                                                                </div>
                                                                <div class="flex-grow-1 cursor-pointer"
                                                                    @click="setPlaceMarker(place, 'destination')">
                                                                    <a href="#"
                                                                        class="text-gray-800 text-hover-primary fw-bold fs-6"
                                                                        v-if="place.structured_formatting"
                                                                        v-text="place.structured_formatting.main_text"></a>
                                                                    <span class="text-muted fw-semibold d-block"
                                                                        v-text="place.description"></span>
                                                                </div>
                                                                <span class="badge badge-light-success fs-8 fw-bold"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" w-full">
                                                <editable_map_location :system_setting="system_setting" :item="activeItem"
                                                    @setlocation="updateDestinationMarker" :key="activeItem.destination_latitude"
                                                    :location="{ lat: activeItem.destination_latitude, lng: activeItem.destination_longitude }">
                                                </editable_map_location>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center"><a href="javascript:;"
                                        class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                        @click="activeTab = 'Driver'" v-text="translate('Driver')"></a></p>
                            </div>

                            <div class="" v-if="activeTab == 'Driver'" :key="activeTab">
                                <div class="card-body pt-0">
                                    <div class="settings-form">
                                        <div class="max-w-xl mb-6 mx-auto row">
                                            <div class="card-body pt-0 mx-auto max-w-xl" :key="drivers">

                                                <div class="text-center mb-13">
                                                    <h1 class="mb-3" v-text="translate('Find Driver')"></h1>

                                                    <div class="text-gray-400 font-semibold "
                                                        v-text="translate('Search by name or mobile')"></div>
                                                </div>
                                                <div class="w-100 relative mb-5" autocomplete="off">

                                                    <vue-feather type="user"
                                                        class="text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></vue-feather>

                                                    <input type="text" @change="findDriver" @input="findDriver" v-model="searchText"
                                                        class="form-control form-control-lg form-control-solid px-15"
                                                        :placeholder="translate('Search by name or mobile')">
                                                </div>
                                                <div class="w-full " v-for="driver in drivers" v-if="searchText">
                                                    <a href="javascript:;" :key="driver.show" v-if="driver && driver.show"
                                                        class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                                        <div class="symbol symbol-35px symbol-circle me-5">
                                                            <car_icon  v-if="!driver.picture" /> 
                                                            <img alt="Pic" v-if="driver.picture" :src="driver.picture">
                                                        </div>
                                                        <div class="fw-semibold w-full">
                                                            <span class="text-lg text-danger font-semibold me-2"
                                                                v-text="driver.name"></span>
                                                            <span class="block text-gray-500 text-sm"
                                                                v-text="driver.mobile"></span>
                                                        </div>
                                                        <span @click="setDriver(driver)" class="btn btn-danger btn-sm text-white"
                                                            v-text="translate('Choose')"></span>
                                                    </a>
                                                </div>

                                                <a href="javascript:;" :key="activeItem.driver" v-if="activeItem.driver"
                                                    class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1 gap-4">
                                                    <div class="symbol symbol-35px symbol-circle me-5">
                                                        <car_icon  v-if="!activeItem.driver.picture" /> 
                                                        <img alt="Pic" v-if="activeItem.driver.picture" :src="activeItem.driver.picture">
                                                    </div>

                                                    <div class="fw-semibold w-full">
                                                        <span class="text-lg text-danger font-semibold me-2"
                                                            v-text="activeItem.driver.name"></span>
                                                        <span class="block text-gray-500 text-sm truncate"
                                                            v-text="activeItem.driver.mobile"></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center"><a href="javascript:;"
                                        class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                        @click="activeTab = 'Vehicle'" v-text="translate('Vehicle')"></a></p>
                            </div>

                            <div class="" v-if="activeTab == 'Vehicle'" :key="activeTab">
                                
                                <div class="card-body pt-0 mx-auto max-w-xl" :key="vehicles">
                                    <div class="text-center mb-13">
                                        <h1 class="mb-3" v-text="translate('Find vehicle')"></h1>

                                        <div class="text-gray-400 font-semibold "
                                            v-text="translate('Search by name or plate number')"></div>
                                    </div>
                                    <div class="w-100 relative mb-5" autocomplete="off">

                                        <vue-feather type="truck"
                                            class="text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></vue-feather>

                                        <input type="text" @type="findVehicle" @input="findVehicle" v-model="searchText"
                                            class="form-control form-control-lg form-control-solid px-15"
                                            :placeholder="translate('Search by name, plate number')">
                                    </div>
                                    <div class="w-full " v-for="vehicle in vehicles" v-if="searchText">
                                        <a href="javascript:;" :key="vehicle.show" v-if="vehicle && vehicle.show"
                                            class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                            
                                            <div class="symbol symbol-35px symbol-circle me-5">
                                                <car_icon  v-if="!vehicle.picture" /> 
                                                <img alt="Pic" v-if="vehicle.picture" :src="vehicle.picture">
                                            </div>
                                            <div class="fw-semibold w-full">
                                                <span class="text-lg text-danger font-semibold me-2"
                                                    v-text="vehicle.vehicle_name"></span>
                                                <span class="block text-gray-500 text-sm"
                                                    v-text="vehicle.plate_number"></span>
                                            </div>
                                            <span @click="setVehicle(vehicle)" class="btn btn-danger btn-sm text-white"
                                                v-text="translate('Choose')"></span>
                                        </a>
                                    </div>
                                    <a href="javascript:;" :key="activeItem.vehicle" v-if="activeItem.vehicle"
                                        class="d-flex align-items-center p-3 bg-gray-100 rounded-lg shadow-md  mb-1">
                                        <div class="symbol symbol-35px symbol-circle me-5">
                                            <car_icon  v-if="!activeItem.vehicle.picture" /> 
                                            <img alt="Pic" v-if="activeItem.vehicle.picture" :src="activeItem.vehicle.picture">
                                        </div>
                                        <div class="fw-semibold w-full">
                                            <span class="text-lg text-danger font-semibold me-2"
                                                v-text="activeItem.vehicle.vehicle_name"></span>
                                            <span class="block text-gray-500 text-sm"
                                                v-text="activeItem.vehicle.plate_number"></span>
                                        </div>
                                    </a>
                                </div>
                                
                                <p class="text-center"><a href="javascript:;"
                                        class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger"
                                        @click="activeTab = 'Time'" v-text="translate('Set Time')"></a></p>
                            </div>

                            <div class="" v-if="activeTab == 'Time'" :key="activeTab">
                                <div class="card-body pt-0"  >
                                    <div class="settings-form" >
                                        <div class="max-w-xl mb-6 mx-auto row" >
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" v-text="translate('Trip Date')" ></label>
                                            <input :required="true" autocomplete="off" name="params[date]" class="form-control form-control-solid" :placeholder="translate('Trip date')" type="date" v-model="activeItem.date">
                                            <hr class="block mt-6 my-2 opacity-10" />

                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" v-text="translate('Pickup time')" ></label>
                                            <input :required="true" autocomplete="off" name="params[start_time]" class="form-control form-control-solid" :placeholder="translate('Pickup time')" type="time" v-model="activeItem.start_time">
                                            
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="activeTab = 'Confirm'" v-text="translate('Next')"></a></p>
                            </div>

                            <div class="" v-if="activeTab == 'Cost'" :key="activeTab">
                                <div class="card-body pt-0"  >
                                    <div class="settings-form" >
                                        <div class="max-w-xl mb-6 mx-auto row" >
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" v-text="translate('Subtotal')" ></label>
                                            <input @change="(activeItem.total_cost = activeItem.subtotal - activeItem.discount_amount)" :required="true" autocomplete="off" name="params[subtotal]" class="form-control form-control-solid" :placeholder="translate('Trip subtotal')" type="number" v-model="activeItem.subtotal">
                                            <hr class="block mt-6 my-2 opacity-10" />

                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" v-text="translate('Discount')" ></label>
                                            <input @change="(activeItem.total_cost = activeItem.subtotal - activeItem.discount_amount)"  :required="true" min="0" :max="activeItem.subtotal" autocomplete="off" name="params[discount]" class="form-control form-control-solid" :placeholder="translate('Trip discount')" type="number" :value="activeItem.discount_amount ?? 0" v-model="activeItem.discount_amount">
                                            <hr class="block mt-6 my-2 opacity-10" />

                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" v-text="translate('Total cost')" ></label>
                                            <input name="params[total_cost]" class="form-control form-control-solid" :placeholder="translate('Trip total cost')" :disabled="true" type="number" v-model="activeItem.total_cost">

                                        </div>
                                    </div>
                                </div>
                                <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="activeTab = 'Confirm'" v-text="translate('Next')"></a></p>
                            </div>

                            <div class="w-full  mx-auto" v-if="activeTab == 'Confirm'" :key="activeTab">
                                
                                <div class="w-full flex gap-10">
                                    <div class="w-full">
                                        <trip_map @markerclicked="markerClicked" class="rounded-xl shadow-md mx-4" :system_setting="system_setting" :conf="conf" :trip="activeItem"  />
                                    </div>
                                    <div class="w-full">
                                        <hr class="block mt-6 my-2 opacity-10" />
                                        <div class="bg-gray-200 shadow-md mb-10 rounded-xl">
                                            <div class="card-header border-0 pt-9">
                                                <div class="card-title m-0 flex  gap-4" v-if="activeItem.model">
                                                    <div class="symbol symbol-50px w-50px bg-light">
                                                        <img  :src="activeItem.model.picture" alt="image" class="p-3" >
                                                    </div>
                                                    <div class="w-full ">
                                                        <div class="font-semibold" v-text="activeItem.model.name"></div>
                                                        <div class="" v-text="activeItem.model.mobile"></div>
                                                    </div>
                                                </div>
                                                <label class=" flex gap-2 cursor-pointer">
                                                    <div class="pt-3">
                                                        <span class="relative badge badge-light fw-bold me-auto px-4 py-3" >
                                                            <form_field class="flex-end" :item="activeItem"
                                                                :column="{ key: 'status', title: translate('Status'), column_type: 'select', text_key:'title', 
                                                                data: tripsStatusList,  hide_text:true }">
                                                            </form_field>
                                                            <vue-feather class="absolute right-4 " type="chevron-down" /> 
                                                        </span>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="card-body p-9" v-if="activeItem">
                                                <div class="timeline timeline-border-dashed">
                                                    
                                                    <div class="timeline-item">
                                                        <div class="timeline-line"></div>
                                                        <div class="timeline-icon me-4"><vue-feather type="circle" class="fs-2 text-success"></vue-feather></div>

                                                        <div class="timeline-content mb-10 mt-n2">
                                                            <div class="overflow-auto pe-3">
                                                                <div class="fs-5 fw-semibold mb-2" v-if="activeItem" v-text="activeItem.pickup_address"></div>

                                                                <div class="d-flex align-items-center mt-1 fs-6">
                                                                    <div class="text-muted me-2 fs-7" v-text="translate('Pickup')"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="timeline-item">
                                                        <div class="timeline-line"></div>
                                                        <div class="timeline-icon me-4"><vue-feather type="map-pin" class="fs-2 text-danger"></vue-feather></div>

                                                        <div class="timeline-content mb-10 mt-n2">
                                                            <div class="overflow-auto pe-3">
                                                                <div class="fs-5 fw-semibold mb-2" v-if="activeItem" v-text="activeItem.destination_address"></div>

                                                                <div class="d-flex align-items-center mt-1 fs-6">
                                                                    <div class="text-muted me-2 fs-7" v-text="translate('Destination')"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="h-4px w-100 bg-light mb-5" >
                                                    <div class="rounded h-4px transition transition-all" role="progressbar" :class="progressWidth() < 100 ? 'bg-info' : 'bg-success'" :style="{width: progressWidth()+'%'}"></div>
                                                </div>
                                                
                                                <div class="w-full flex gap-4" v-if="activeItem">
                                                    
                                                    <div class="flex gap-4 min-w-250px  " v-if="activeItem.driver">
                                                        <img :src="activeItem.driver.picture" class="rounded-full bg-white border-1 border border-gray-600 p-1 w-12 h-12" />
                                                        <div class="block gap-4 w-full">
                                                            <span class="w-full block font-semibold" v-text="translate('Driver')"></span>
                                                            <span class="w-full block" v-text="activeItem.driver.name"></span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="w-150px flex gap-4" v-if="activeItem.vehicle">
                                                        <car_icon />
                                                        <div class="block gap-4">
                                                            <span class="w-full block font-semibold" v-text="translate('Vehicle')"></span>
                                                            <span class="w-full block" v-text="activeItem.vehicle.plate_number"></span>
                                                        </div>
                                                    </div>

                                                    <div class="w-125px flex-end" v-if="activeItem.date">
                                                        <span class="w-full block font-semibold" v-text="translate('Trip date')"></span>
                                                        <div class="w-full flex gap-4">
                                                            <span class=" " v-text="activeItem.date"></span>
                                                            <span class=" " v-text="activeItem.start_time"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex gap-6 pb-4 font-semibold text-lg">
                                                
                                            <div class="flex gap-6 w-full">
                                                <div v-text="translate('Subtotal')"></div>
                                                <div v-text="currency.symbol +''+ activeItem.subtotal"></div>
                                            </div>

                                            <div class="flex gap-6 w-full">
                                                <div v-text="translate('Discount')"></div>
                                                <div v-text="currency.symbol +''+ activeItem.discount_amount"></div>
                                            </div>

                                            <div class="flex gap-6 w-full">
                                                <div v-text="translate('Total cost')"></div>
                                                <div v-text="currency.symbol +''+ activeItem.total_cost"></div>
                                            </div>

                                        </div>

                                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-12 p-6"><i class="vue-feather vue-feather--alert-octagon ki-duotone ki-information fs-2tx text-warning me-4" data-name="alert-octagon" data-tags="warning,alert,danger" data-type="alert-octagon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon vue-feather__content"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg></i><div class="d-flex flex-stack flex-grow-1"><div class="fw-semibold"><h4 class="text-gray-900 fw-bold" v-text="activeItem.payment_status"></h4><div class="fs-6 text-gray-700">
                                                <div v-text="translate('Payment status')"></div>
                                        </div></div></div></div>
                                    </div>
                                </div>
                                <p class="text-center mt-10"><a href="javascript:;" class="uppercase px-4 py-3 mx-2 text-center text-white rounded-lg bg-danger" @click="saveTrip" v-text="translate('Submit')"></a></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
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
import { translate, getProgressWidth, handleRequest, deleteByKey, showAlert, handleAccess, getPositionAddress, findPlaces, getPlaceDetails,today } from '@/utils.vue';

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
import tooltip from '@/components/includes/tooltip.vue';
import trip_map from '@/components/maps/trip_map.vue';

export default
    {
        components: {
            'datatabble': Vue3EasyDataTable,
            SideFormCreate,
            SideFormUpdate,
            trip_map,
            close_icon,
            delete_icon,
            car_icon,
            form_field,
            editable_map_location,
            tooltip,
        },
        name: 'Private trips',
        emits: ['callback'],
        setup(props, { emit }) {

            const loading = ref(false);
            const showAddSide = ref(false);
            const showEditSide = ref(false);
            const showProfilePage = ref(null);
            const activeItem = ref({});
            const activeTab = ref(props.usertype);
            const content = ref({});
            const center = ref({});
            const locations = ref([]);
            const showList = ref(true);
            const searchText = ref('');
            const locationError = ref(null);
            const collapsed = ref(false);
            const fillable = ref([props.usertype, 'Pickup location', 'Destination',  'Driver', 'Vehicle', 'Time', 'Cost', 'Confirm']);
            const places = ref([]);
            const showPlaceSearch = ref(false);
            const pickup_placeSearch = ref('');
            const destination_placeSearch = ref('');
            const tripsStatusList = ref([
                {title: translate("Scheduled"), status: 'scheduled'},
                {title:translate("Started"), status: 'started'},
                {title:translate("Completed"), status: 'completed'},
                {title:translate("Cancelled"), status: 'cancelled'},
            ]);

            console.log(props.item)
            
            if (props.item) {
                activeItem.value = props.item
                activeItem.value.date =  props.item.date ?? today()
            } else {
                activeItem.value.date = today()
            }

            const users = (props.userslist) ? ref(props.userslist) : ref([]);

            /**
             * Get current location
             */
            const getUserLocation = async () => {
                if (navigator.geolocation )  {
                    navigator.geolocation.getCurrentPosition
                        (
                            position => {
                                if (!activeItem.value.trip_id)
                                {
                                    activeItem.value.pickup_latitude = position.coords.latitude;
                                    activeItem.value.pickup_longitude = position.coords.longitude;
                                    activeItem.value.destination_latitude = position.coords.latitude;
                                    activeItem.value.destination_longitude = position.coords.longitude;
                                }
                            },
                            error => {

                                if (!activeItem.value.trip_id)
                                {
                                    activeItem.value.pickup_latitude = activeItem.value.pickup_latitude ?? 30.06;
                                    activeItem.value.pickup_longitude = activeItem.value.pickup_longitude ?? 31.21;
                                    activeItem.value.destination_latitude = activeItem.value.destination_latitude ?? 30.06;
                                    activeItem.value.destination_longitude = activeItem.value.destination_longitude ?? 31.21;
                                }
                                showAlert(error.message)
                            }
                        );

                } else {
                    showAlert('location error')
                    locationError.value = "Geolocation is not supported by this browser.";
                }
            }

            getUserLocation();

            const pickupPlaceChanged = async () => {
                let result = pickup_placeSearch.value.length > 3 ? await findPlaces(props.system_setting.google_map_api, pickup_placeSearch.value, props.business_setting.country) : ''
                places.value = result.predictions;
            }

            const destinationPlaceChanged = async () => {
                let result = destination_placeSearch.value.length > 3 ? await findPlaces(props.system_setting.google_map_api, destination_placeSearch.value, props.business_setting.country) : ''
                places.value = result.predictions;
            }

            const saveTrip = () => {
                loading.value = true;
                var params = new URLSearchParams();
                let array = JSON.parse(JSON.stringify(activeItem.value));
                let keys = Object.keys(array)
                let k, d, value = '';
                for (let i = 0; i < keys.length; i++) {
                    k = keys[i]
                    d = typeof array[k] === 'object' ? JSON.stringify(array[k]) : array[k]
                    params.append('params[' + k + ']', d)
                }
                let type = array.trip_id > 0 ? 'update' : 'create';
                params.append('type', 'PrivateTrip.' + type)
                handleRequest(params, '/api/' + type).then(response => {
                    handleAccess(response)
                    loading.value = false;
                })
            }

            const updatePickupMarker = async (position) => {
                activeItem.value.pickup_latitude = position.lat();
                activeItem.value.pickup_longitude = position.lng();
                activeItem.value.pickup_address = await getPositionAddress(position.lat(), position.lng())
            }

            const updateDestinationMarker = async (position) => {
                activeItem.value.destination_latitude = position.lat();
                activeItem.value.destination_longitude = position.lng();
                activeItem.value.destination_address = await getPositionAddress(position.lat(), position.lng())
            }


            const setPlaceMarker = async (placeInfo, type) => {
                const placesService = new google.maps.places.PlacesService(document.createElement('div'));

                let placeId = placeInfo.place_id;

                placesService.getDetails({ placeId }, (place, status) => {
                    if (status === google.maps.places.PlacesServiceStatus.OK && place) {
                        const location = place.geometry.location;


                        if (type == 'pickup') {
                            activeItem.value.pickup_address = placeInfo.description
                            activeItem.value.pickup_latitude = location.lat()
                            activeItem.value.pickup_longitude = location.lng()
                        }

                        if (type == 'destination') {
                            activeItem.value.destination_address = placeInfo.description
                            activeItem.value.destination_latitude = location.lat()
                            activeItem.value.destination_longitude = location.lng()
                        }
                        places.value = []
                        showPlaceSearch.value = false
                    } else {
                        console.error('Failed to fetch place details');
                    }
                });
            }

            const back = () => {
                emit('callback');
            }

            const progressWidth = () => 
            {
                let requiredData = ['model_id', 'driver_id', 'pickup_address', 'destination_address','status'];
                
                return getProgressWidth(requiredData, activeItem);
            }

            const setUser = (user) => {
                activeItem.value.model_id = props.usertype == 'student' ? user.student_id : user.customer_id;
                activeItem.value.model = user;
                activeTab.value = 'Pickup location';
                searchText.value = null;
            }

            const setDriver = (driver) => {
                activeItem.value.driver_id = driver.driver_id;
                activeItem.value.driver = driver;
                activeTab.value = 'Vehicle';
                searchText.value = null;
            }

            const setVehicle = (vehicle) => {
                activeItem.value.vehicle_id = vehicle.vehicle_id;
                activeItem.value.vehicle = vehicle;
                activeTab.value = 'Time';
                searchText.value = null;
            }
            

            const findDriver = () => {

                if (props.drivers)
                {
                    for (let i = 0; i < props.drivers.length; i++) {
                        props.drivers[i].show = searchText.value.trim() ? checkSimilarDriver(props.drivers[i]) : 1;
                    }
                }
            }
            
            const checkSimilarDriver = (item) => {
                let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return  name ? name : (item.mobile).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
            }
            

            const findVehicle = () => 
            {
                if (props.vehicles)
                {
                    for (let i = 0; i < props.vehicles.length; i++) {
                        props.vehicles[i].show = searchText.value.trim() ? checkSimilarVehicle(props.vehicles[i]) : 1;
                    }
                }
            }

            const checkSimilarVehicle = (item) => {
                let name = (item.vehicle_name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return name ? name : (item.plate_number).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
            }

            
            const findUser = () => 
            {
                if (props.userslist)
                {
                    for (let i = 0; i < props.userslist.length; i++) {
                        props.userslist[i].show = searchText.value.trim() ? checkSimilarUser(props.userslist[i]) : 1;
                    }
                }
            }

            const checkSimilarUser = (item) => {
                let name = (item.name).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                let email = name ? name : (item.email).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
                return email ? email : (item.mobile).toLowerCase().includes(searchText.value.toLowerCase()) ? true : false;
            }


            const selectedObject = (array, key) => 
            {
                const keyValue = activeItem.value[key];
                for (let i = 0; i < array.length; i++) {
                    if (array[i][key] == keyValue)
                    {
                        return array[i]
                    }
                }
                return {}
            }


            return {
                loading,
                tripsStatusList,
                selectedObject,
                findDriver,
                setDriver,
                findVehicle,
                setVehicle,
                users,
                progressWidth,
                setUser,
                findUser,
                setPlaceMarker,
                showPlaceSearch,
                pickupPlaceChanged,
                destinationPlaceChanged,
                pickup_placeSearch,
                destination_placeSearch,
                places,
                showAddSide,
                showEditSide,
                content,
                fillable,
                center,
                activeItem,
                activeTab,
                translate,
                updatePickupMarker,
                updateDestinationMarker,
                searchText,
                getUserLocation,
                collapsed,
                saveTrip,
                back
            };
        },

        props: [
            'conf',
            'path',
            'system_setting',
            'business_setting',
            'setting',
            'item',
            'userslist',
            'usertype',
            'drivers',
            'vehicles',
            'currency'
        ],

    };
</script>