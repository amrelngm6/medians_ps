<template>
    <div>

        <medians-calendar
            ref="medians_calendar"
            :configuration="calendar_settings"
            :events="[]"
            :settings="settings"
            :devices="devices"

            @set-event="setEvent"
            @set-new-event="setNewItem"
            @set-active-event="setActiveItem"
            @update-event="updateEvent"
            @update-info="updateInfo"
            @show_event="show_event"
            @show_modal="show_modal"
            ></medians-calendar>


        <div v-if="showPopup" class="relative" style="z-index: 999">
            <div class="fixed top-0 left-0 w-full h-full"  style="z-index: 99;">
                <div class="absolute top-0 left-0 w-full h-full" @click="hidePopup" style="background: rgba(0,0,0,.6);"></div>
                <div class="absolute top-0 left-0  right-0 bottom-0 m-auto w-40 h-40" v-if="!activeItem" >
                    <img src="/uploads/images/loader.gif"  />
                </div>
                <div class="left-0 right-0 fixed mx-auto w-full " v-if="activeItem" style="max-width: 600px; z-index: 99;" >
                    
                    <div v-if="showModal && !activeItem.allow"  class="relative h-full ">
                        <calendar_new_item :modal="activeItem" :games="activeItem.device ? activeItem.device.games : []"></calendar_new_item>
                    </div>

                    <div v-if="showModal  && activeItem.id > 0 && activeItem.status == 'active'"  class="relative h-full ">

                        <calendar_booking_confirm v-if="showConfirm" :modal="activeItem"></calendar_booking_confirm>
                        
                        <calendar_active_item :modal="activeItem"></calendar_active_item>
                    </div>

                    <div v-if="showBooking  && (activeItem.status == 'completed' || activeItem.status == 'paid')" class="relative h-full ">
                        <calendar_modal :modal="activeItem"></calendar_modal>
                    </div>
                </div>
            </div>  
        </div>

        <div class="w-full h-full fixed top-0 left-0" v-if="showCart" style="z-index:999">
            <div v-if="showCart" @click="showCart = false ; hidePopup" class="fixed h-full w-full top-0 left-0 bg-gray-800" style="opacity: .6; z-index:9"></div>
            <side_cart  v-if="showCart" ref="side_cart" :setting="settings" :currency="settings.currency"></side_cart>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
import {MediansCalendar} from 'medians-calendar';

export default {
    components: {
        MediansCalendar,
    },
    props: {
        // this provided array will be kept in sync
        devices: {
            required: true,
            type: Array,
            validator: function(val) {
                return  Array.isArray(val) || typeof val === 'object';
            },
        },
        
        // this provided array will be kept in sync
        settings: {
            required: false,
            type: Array | Object,
        },
        
    },
    data() {
        return {
            showCalendar: true,
            showPopup:false,
            showModal:false,
            showCart:false,
            showConfirm:false,
            showBooking:false,
            activeItem:{},
            events:[],
            current_day: moment().format('YYYY-MM-DD'),
            
            // Calendar Settings
            calendar_settings: {
              style: 'material_design',
              view_type: 'day',
              events_url: '/api/calendar_events',
              cell_height: 20,
              column_minwidth: 220,
              animation_speed: 100,
              scrollToNow: true,
              start_day: new Date().toISOString(),
              read_only: false,
              day_starts_at: 0,
              day_ends_at: 24,
              overlap: false,
              hide_days: [],
              past_event_creation: true
            },
            events: null,
            new_appointment: {},
            scrollable: true,
        };
    },
    computed: {

    },
    created() {
        this.current_day = this.calendar_settings.start_day;
    },
    provide() {
    },
    methods: {
       
        addToCart(activeItem)
        {
            let item = {};
            this.showCart = true;
            if (activeItem)
            {
                item.id = activeItem.id;
                item.device = activeItem.device;
                item.price = activeItem.price;
                item.duration_time = activeItem.duration_time;
                item.duration_hours = activeItem.duration_hours;
                item.subtotal = activeItem.subtotal;
                item.game = activeItem.game;
                item.products = activeItem.products;
            }
            this.hidePopup(false);
            var t = this;

            setTimeout(function () {
                t.$refs.side_cart ? t.$refs.side_cart.addToCart(item) : null;
            }, 1000)
        },
        /**
         * Update event data
         */
        updateInfo(activeItem)
        {
            this.showPopup = false; 
            this.activeItem = activeItem;
            this.showPopup = true

            return this;
        } ,

        log(data)
        {
            this.$parent.log(data);
        },

        show_modal(item = null){
            this.showPopup = false; 
            if (item)
            {
                if (item.id && item.status && item.status == 'active')
                    this.setActiveItem(item);

                if (item.status && item.status == 'completed')
                    this.show_event(item);

                if (item.status && item.status == 'paid')
                    this.show_event(item);

                if (!item.id)
                    this.setNewItem(item);
            }

            this.showPopup = true; 

        },

        show_event(item = null){
            this.showModal = false;
            this.setEvent(item);
            this.showBooking = true;
        },

        /** 
         * Set active item
         * 
         */
        setNewItem(newEvent)
        {
            console.log(newEvent)
            let startDate = moment(newEvent.starting_cell.time);

            let endDate = (newEvent.ending_cell.value === newEvent.starting_cell.value) 
            ? moment(newEvent.ending_cell.time).add(60, 'minutes')
            : moment(newEvent.ending_cell.time);

            this.activeItem = JSON.parse(JSON.stringify(newEvent))
            this.games = newEvent.device ? newEvent.device.games : []
            this.activeItem.device_id = newEvent.device ? newEvent.device.id : 0
            this.activeItem.start = startDate.format('HH:mm')
            this.activeItem.start_time = startDate.format('YYYY-MM-DD HH:mm')
            this.activeItem.end = endDate.format('HH:mm')
            this.activeItem.end_time = endDate.format('YYYY-MM-DD HH:mm')
            this.activeItem.date = endDate.format('YYYY-MM-DD')
            this.showModal = true
        },


        /** 
         * Set active item
         * '
         */
        setActiveItem(props)
        {
            console.log(props)

            this.activeItem = JSON.parse(JSON.stringify(props))
            this.games = props.device ? props.device.games : []
            this.activeItem.startStr = props.start
            this.activeItem.start = moment(props.from).format('HH:mm')
            this.activeItem.start_time = moment(props.from).format('YYYY-MM-DD HH:mm')
            this.activeItem.end = moment(props.to).format('HH:mm')
            this.activeItem.end_time = moment(props.to).format('YYYY-MM-DD HH:mm')
            this.activeItem.date = moment(props.from).format('YYYY-MM-DD')
            this.activeItem.subtotal = this.subtotal();
            this.showModal = true
            return this;
        },


        /** 
         * Set active item
         * '
         */
        setEvent(props)
        {
            this.activeItem = JSON.parse(JSON.stringify(props))
            this.activeItem.startStr = props.start
            this.activeItem.subtotal = this.subtotal();
            this.showModal = true
            return this;
        },

        /**
         * Update event data
         */
        storeInfo(activeItem)
        {
            this.submit('Event.create', activeItem)
        },


        /**
         * Update event data
         */
        updateEvent(event, device, cellData)
        {

            let newEvent = JSON.parse(JSON.stringify(event))
            newEvent.from = moment(cellData.time).format('YYYY-MM-DD HH:mm');
            newEvent.to = moment(cellData.time).add(event.duration, 'minutes').format('YYYY-MM-DD HH:mm');
            newEvent.device_id = device.id;
            this.submit('Event.update', newEvent);
            this.log(newEvent)
        },

        

        /**
         * Update event data
         */
        submit(type, newitem = null) {

            let item = newitem ? newitem : this.activeItem;

            let request_type = type.includes('create') ? 'create' : 'update';

            const params = new URLSearchParams([]);
            item.start_time = this.current_day+ ' ' +item.start
            item.end_time = this.current_day+ ' ' +item.end
            params.append('type', type);
            params.append('params[event]', JSON.stringify(item));
            this.handleRequest(params, '/api/'+request_type).then(data => { 
                this.reloadEvents()
                this.hidePopup();

            });
        },

        subtotal()
        {
            let price = this.activeItem.device_cost;

            return (Number(price) * Number(this.activeItem.duration_hours)).toFixed(2) ;
        },
        hidePopup(reload = true)
        {
            this.showBooking = false;
            this.showModal = false;
            this.showConfirm = false;
            this.showPopup = false;

        },


        reloadEvents() {
            this.$refs.medians_calendar.reloadEvents()
        },

        /**
         * Load events 
         */
        async handleGetRequest(url) {

            // Demo json data
            return await this.$parent.handleGetRequest(url);
        },

        async handleRequest(params, url='/') {
            return await this.$parent.handleRequest(params, url);
        },
        __(i)
        {
            return this.$parent.__(i);
        },

    },
};
</script>
