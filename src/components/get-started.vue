<template>
    <div class="mx-auto w-10/12 py-8">
        <h2 class="text-xl" v-text="__('get_started_setting')"></h2>
        <p class="py-4 " v-text="__('complete_this_settings_to_start')"></p>
        <div class="mx-auto  rounded-lg py-8 px-4 lg:flex gap-6" v-if="steps && !showLoader">
            <div class="w-1/3 bg-white p-6 no-mobile">
                <div v-for="step in steps" :key="step.active" class="w-full mb-4">
                    <div :class="step.active ? '' : 'text-gray-300'" @click="setActiveStep(step.id)" class="cursor-pointer w-full flex ">
                        <span :class="step.active ? 'bg-blue-50' : ''" class="block w-10 h-10 pt-2 text-center " v-text="step.id"></span>
                        <p class="block  mx-4">
                            <span class="block w-full font-semibold text-base" v-text="step.title"></span>
                            <span class="text-sm  " v-text="step.info"></span>
                        </p>
                    </div>
                    <div v-if="step.id < 4" class="mb-4">
                        <span class="block w-10 h-8 text-center "><span class="border-l mb-2 mx-auto w-1 h-12 "></span></span>
                    </div>
                </div>
            </div>
            <div class="w-2/3">
                <div class="w-full" id="step1" v-if="activeStep == 1">
                    <p class="text-lg font-semibold" v-text="__('Business information')"></p>
                    <p class=" font-normal" v-text="__('information about the branch')"></p>
                    <hr class="py-2 mt-4" />
                    <div class="relative py-4"><label class="nui-label w-full pb-2 block font-semibold " for="ninja-input-89" v-text="__('Branch name')"></label>
                        <div class="group/nui-input relative">
                            <input id="ninja-input-89" type="text" class="nui-focus border-muted-300 text-muted-600 placeholder:text-muted-300  peer w-full border bg-white font-sans transition-all duration-300 disabled:cursor-not-allowed disabled:opacity-75 px-2 h-10 py-2 text-sm leading-5 pe-4 ps-9 rounded-lg !h-11 !ps-11" placeholder="Ex: Medians PS" v-model="activeItem.branch_name">
                        </div>
                    </div>
                    <div class="block  w-full">
                        <div class="mx-auto w-40 flex flex-end items-center gap-4 py-6">
                            <!-- <button type="button" class="is-button rounded-lg is-button-default !h-12 w-full">Back</button> -->
                            <button type="button" @click="saveBranch()" class="is-button rounded-lg bg-purple-800 text-white h-12 w-full" v-text="__('Next')"></button>
                        </div>
                    </div>
                </div>
                <div class="w-full" id="step2" v-if="activeStep == 2">
                    <p class="text-lg font-semibold" v-text="__('Settings')"></p>
                    <p class=" font-normal" v-text="__('important required settings')"></p>
                    <hr class="py-2 mt-4" />
                    <div class="relative py-4">
                        <label class="nui-label w-full pb-2 block font-semibold " for="ninja-input-89" v-text="__('Language')"></label>
                        <div class="group/nui-input relative">
                            <select name="params[settings][lang]" v-model="activeItem.lang" class="select h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600">
                                <option value="english">English</option>
                                <option value="arabic">العربية</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full ">
                        <div class="w-full relative py-4">
                            <label class="nui-label w-full pb-2 block font-semibold " for="ninja-input-89" v-text="__('Currency')"></label>
                            <div class="group/nui-input relative">
                                <input name="params[settings][currency]" v-model="activeItem.currency" type="text" :placeholder="__('Currency')" required="required" class="h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600">
                            </div>
                        </div>
                    </div>
                    <div class="block  w-full">
                        <div class="mx-auto w-40 flex flex-end items-center gap-4 py-6">
                            <button type="submit" class="is-button rounded-lg bg-purple-800 text-white h-12 w-full" @click="saveSetting()" v-text="__('Next')"></button>
                        </div>
                    </div>
                </div>
                <div class="w-full" id="step3" v-if="activeStep == 3">
                    <p class="text-lg font-semibold" v-text="__('plan')"></p>
                    <p class=" font-normal" v-text="__('Subscribe to plan')"> </p>
                    <hr class="py-2 mt-4" />
                    <div class="block  w-full" v-if="content.plans">
                        <div class="my-2 m-auto -space-y-4 items-center justify-center md:flex md:space-y-0 md:-space-x-4 xl:w-10/12">
                            <div class="relative z-10 -mx-4 group md:w-6/12 md:mx-0 lg:w-5/12">
                                <div aria-hidden="true" class="absolute top-0 w-full h-full rounded-lg bg-white shadow-xl transition duration-500 group-hover:scale-105 lg:group-hover:scale-110"></div>
                                <div class="relative p-6 space-y-6 lg:p-8" v-if="activePlan">
                                    <h3 class="text-3xl text-gray-700 font-semibold text-center" v-text="activePlan.name"></h3>
                                    <div class="relative ">
                                        <div class="flex items-end mt-6 w-full ">
                                            <span class="text-8xl text-gray-800 font-bold leading-0">$</span>
                                            <div class="w-full pb-2 flex gap-4">
                                                <span class="w-full block text-xl text-purple-500 font-bold" v-text="cost()"></span>
                                                <small class="cursor-pointer" v-for="priceItem in pricesList" :class="activePrice == priceItem ? 'font-semibold' : ''" @click="switchPlanPrice(priceItem)" v-text="__(priceItem)"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <ul role="list" class="w-max space-y-4 py-6 m-auto text-gray-600">
                                        <li class="space-x-2 py-1 gap-4 flex">
                                            <span class="text-purple-500 font-semibold">&check;</span>
                                            <span>Calendar & devices management</span>
                                        </li>
                                        <li class="space-x-2 py-1 gap-4 flex">
                                            <span class="text-purple-500 font-semibold">&check;</span>
                                            <span>Tournaments & Notifications</span>
                                        </li>
                                        <li class="space-x-2 py-1 gap-4 flex">
                                            <span class="text-purple-500 font-semibold">&check;</span>
                                            <span>24/7 Free Support</span>
                                        </li>
                                        <li class="space-x-2 py-1 gap-4 flex">
                                            <span class="text-purple-500 font-semibold">&check;</span>
                                            <span>Multi-language</span>
                                        </li>
                                    </ul>
                                    <button type="button" title="Submit" @click="setActiveStep(4)"  class="block w-full py-3 px-6 text-center rounded-lg transition bg-purple-600 hover:bg-purple-700 active:bg-purple-800 focus:bg-indigo-600">
                                        <span class="text-white font-semibold" v-text="__('Choose plan')"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="relative group lg:w-80">
                                <div aria-hidden="true" class="absolute top-0 w-full h-full rounded-lg bg-white shadow-lg transition duration-500 group-hover:scale-105"></div>
                                <div class="relative p-6 pt-16 md:p-8 md:pl-12 md:rounded-r-2xl lg:pl-20 lg:p-16">
                                    <!-- <p class="font-semibold ">Premium features</p> -->
                                    <ul role="list" class="space-y-4 py-6 text-gray-600">
                                        <li class="space-x-2 py-1 gap-4 flex">
                                            <span v-html="activePlan.paid ? '&check;' : '&#10006;'" class="text-purple-500 font-semibold"></span>
                                            <span>AI Reports</span>
                                        </li>
                                        <li class="space-x-2 py-1 gap-4 flex">
                                            <span v-html="activePlan.paid ? '&check;' : '&#10006;'" class="text-purple-500 font-semibold"></span>
                                            <span>Unlimited devices</span>
                                        </li>
                                        <li class="space-x-2 py-1 gap-4 flex">
                                            <span v-html="activePlan.paid ? '&check;' : '&#10006;'" class="text-purple-500 font-semibold"></span>
                                            <span>Multi-branches</span>
                                        </li>
                                    </ul>
                                    <p class="text-gray-700">Choose your suitable plan </p>
                                    <div class="mt-6 flex justify-between gap-2" v-if="content.plans">
                                        <a v-for="plan in content.plans" :class="plan.paid ? 'bg-purple-600 text-white' : 'border'" class="py-2 px-4 rounded-lg border" href="javascript:;" v-text="plan.name" @click="activePlan = plan"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full" id="step3" v-if="activeStep == 4">
                    <p class="text-lg font-semibold" v-text="__('Review and confirm')"></p>
                    <p class=" font-normal" v-text="__('Review your information and confirm')"> </p>
                    <hr class="py-2 mt-4" />
                    <div class="block  w-full">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="payment__success__inner">
                                    <div class="payment__success__header">
                                        <h2 v-text="__('Confirmation')"></h2>
                                    </div>
                                    <div class="relative bg-white mt-4 p-5 py-10 sm:rounded-3xl sm:px-10">
                                        <div class="w-full">
                                            <h2 class="text-base font-semibold leading-7 text-slate-900" v-text="activePlan.name"></h2>
                                            <p class="text-sm leading-6 text-slate-700" v-text=""></p>
                                        </div>
                                        <h3 class="sr-only">All-access features</h3>
                                        <ul class="mt-8 space-y-8 text-sm leading-6 text-slate-700">
                                            <li class="flex py-2">
                                                <p class="w-full ml-6"><strong class="font-semibold text-slate-900" v-text="__('Start date')"></strong>— <span v-text="today()"></span></p>
                                                <p class="w-full ml-6"><strong class="font-semibold text-slate-900" v-text="__('End date')"></strong>— <span v-text="endDate()"></span></p>
                                            </li>
                                            <li class="flex py-2" v-if="activePlan.paid">
                                                <p class="w-full ml-6"><strong class="font-semibold text-slate-900" v-text="__('Payment method')"></strong></p>
                                                <p class="w-full ml-6 flex gap-2 font-semibold text-lg"><svg width="30px" height="30px" viewBox="-3.5 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <title>Paypal-color</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs> </defs>
                                                        <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <g id="Color-" transform="translate(-804.000000, -660.000000)" fill="#022B87">
                                                                <path d="M838.91167,663.619443 C836.67088,661.085983 832.621734,660 827.440097,660 L812.404732,660 C811.344818,660 810.443663,660.764988 810.277343,661.801472 L804.016136,701.193856 C803.892151,701.970844 804.498465,702.674333 805.292267,702.674333 L814.574458,702.674333 L816.905967,688.004562 L816.833391,688.463555 C816.999712,687.427071 817.894818,686.662083 818.95322,686.662083 L823.363735,686.662083 C832.030541,686.662083 838.814901,683.170138 840.797138,673.069296 C840.856106,672.7693 840.951363,672.194809 840.951363,672.194809 C841.513828,668.456868 840.946827,665.920407 838.91167,663.619443 Z M843.301017,674.10803 C841.144899,684.052874 834.27133,689.316292 823.363735,689.316292 L819.408334,689.316292 L816.458414,708 L822.873846,708 C823.800704,708 824.588458,707.33101 824.733611,706.423525 L824.809211,706.027531 L826.284927,696.754676 L826.380183,696.243184 C826.523823,695.335698 827.313089,694.666708 828.238435,694.666708 L829.410238,694.666708 C836.989913,694.666708 842.92604,691.611256 844.660308,682.776394 C845.35583,679.23045 845.021677,676.257496 843.301017,674.10803 Z" id="Paypal"> </path>
                                                            </g>
                                                        </g>
                                                    </svg> PayPal</p>
                                            </li>
                                        </ul>
                                        <div class="relative -mx-5 mt-8 ring-1 ring-slate-900/5 sm:mx-0 sm:rounded-2xl">
                                            <div class="flex absolute -bottom-px left-1/2 -ml-48 h-[2px] w-96">
                                                <div class="w-full flex-none blur-sm [background-image:linear-gradient(90deg,rgba(56,189,248,0)_0%,#0EA5E9_32.29%,rgba(236,72,153,0.3)_67.19%,rgba(236,72,153,0)_100%)]"></div>
                                                <div class="-ml-[100%] w-full flex-none blur-[1px] [background-image:linear-gradient(90deg,rgba(56,189,248,0)_0%,#0EA5E9_32.29%,rgba(236,72,153,0.3)_67.19%,rgba(236,72,153,0)_100%)]"></div>
                                                <div class="-ml-[100%] w-full flex-none blur-sm [background-image:linear-gradient(90deg,rgba(56,189,248,0)_0%,#0EA5E9_32.29%,rgba(236,72,153,0.3)_67.19%,rgba(236,72,153,0)_100%)]"></div>
                                                <div class="-ml-[100%] w-full flex-none blur-[1px] [background-image:linear-gradient(90deg,rgba(56,189,248,0)_0%,#0EA5E9_32.29%,rgba(236,72,153,0.3)_67.19%,rgba(236,72,153,0)_100%)]"></div>
                                            </div>
                                            <div class="relative flex flex-col bg-slate-50 px-5 py-8 sm:rounded-2xl">
                                                <p class="flex items-center justify-center gap-6"><span class="text-[2.5rem] leading-none text-slate-900">$<span class="font-bold" v-text="cost()"></span></span><span class="ml-3 text-sm"><span class="font-semibold text-slate-900" v-text="__('yearly payment')"></span><br><span class="text-slate-500" v-text="__('include local taxes')"></span></span></p>
                                                <p class="order-last -mx-1 mt-4 flex justify-center text-sm leading-6 text-slate-500 sm:space-x-2"><span class="sm:hidden" v-text="__('Includes free updates and technical support')"></span></p>
                                                <a @click="complete()" class="inline-flex justify-center rounded-lg text-sm font-semibold py-2 px-3 bg-slate-900 text-white hover:bg-slate-700 mt-6 w-full" href="#"><span v-text="__('subscribe')"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment'

export default {
    name: 'get-started',
    data() {
        return {
            url: this.conf.url + 'get_started?load=json',
            content: {
                plans: [],
            },
            pricesList: ['monthly', 'yearly'],
            activePrice: 'yearly',
            activePlan: {},
            showLoader: false,
            activeItem: {},
            activeStep: this.handleActiveStep(),
            steps: [
                { id: 1, title: this.__('Business information'), info: this.__('information about the branch'), active: 1 },
                { id: 2, title: this.__('Settings'), info: this.__('important required settings'), active: (this.handleActiveStep() > 1) ? 1 : 0 },
                { id: 3, title: this.__('Plan'), info: this.__('Subscribe to plan'), active: (this.handleActiveStep() > 2) ? 1 : 0  },
                { id: 4, title: this.__('Review and confirm'), info: this.__('Review your information and confirm'), active: 0 }
            ],

        }
    },

    props: [
        'conf', 'setting', 'auth'
    ],
    mounted() {
        this.load()
        if (this.setting)
            this.activeItem = this.setting
    },

    methods: 
    {

        /**
         * Get Today date
         * 
         */
        today()
        {
            return moment().format('YYYY-MM-DD')
        },

        /**
         * Get end Date based on plan
         */
        endDate()
        {
            let days = this.activePrice == 'monthly' ? 30 : 365;

            return moment().add(days, 'days').format('YYYY-MM-DD')

        },  

        /**
         * Switch the plan price between
         * ( Monthly - Yearly )
         */
        switchPlanPrice(type) {
            this.showLoader = true;
            this.activePrice = type;
            this.showLoader = false;
        },

        /**
         * Cost of current plan
         */
        cost() {
            let cost = this.activePrice == 'monthly' ? this.activePlan.monthly_cost : this.activePlan.yearly_cost;

            return cost ? cost.toFixed(2) : '0.00'
        },

        /**
         * Load plans
         */
        load() {
            this.showLoader = true;
            this.$parent.handleGetRequest(this.url).then(response => {
                this.setValues(response)
                this.showLoader = false;
            });
        },

        /**
         * Set the reponse to Content object
         */
        setValues(data) {
            this.content = JSON.parse(JSON.stringify(data));
            this.activePlan = this.content.plans[1]
            return this
        },

        /**
         * Check default step
         */
        handleActiveStep() 
        {
            if ((this.auth && !this.auth.branch))
                return 1

            if (!this.setting || (this.setting && !this.setting.lang))
                return 2

            if (this.setting && this.setting.lang)
                return 3
        },

        /**
         * Switch between steps
         */
        setActiveStep(id) {
            if (this.validateStep(id))
                return this.$alert(this.validateStep(id));

            this.showLoader = true
            for (var i = this.steps.length - 1; i >= 0; i--) {

                if (i && this.steps[i].id == id && this.steps[i - 1] && this.steps[i - 1].active && this.steps[i].id) {
                    this.steps[i].active = true
                }

                if (this.steps[i] && this.steps[i].active && this.steps[i].id == id) {

                    this.activeStep = this.steps[i].id
                }
            }
            this.showLoader = false
        },


        /**
         * Save branch name
         */
        saveBranch() {
            const params = new URLSearchParams([]);
            params.append('type', 'User.get_started_save_branch');
            params.append('params[name]', this.activeItem.branch_name);
            this.handleRequest(params, '/api/create').then(data => {
                data.error ? this.$alert(data.error) : ''
                data.success ? this.setActiveStep(2) : ''
            });
        },

        validateStep(id) {
            if (id == 2 && !this.activeItem.branch_name)
                return this.__('branch_name_required')

            if (id == 4 && !this.activePlan)
                return this.__('Select plan first')

        },

        /**
         * Save branch name
         */
        saveSetting() {
            const params = new URLSearchParams([]);
            params.append('type', 'User.get_started_save_setting');
            params.append('params[settings][sitename]', this.activeItem.branch_name);
            params.append('params[settings][lang]', this.activeItem.lang);
            params.append('params[settings][currency]', this.activeItem.currency);
            params.append('params[settings][tax]', this.activeItem.tax);
            this.handleRequest(params, '/api/create').then(data => {
                this.$alert(data.error ? data.error : data.result)
                data.success ? this.setActiveStep(3) : ''
            });
        },

        /**
         * Complete and go start
         * 
         */
        complete() {

            if (!this.activePlan.id)
                return this.$alert(this.__('Select plan first'));

            const params = new URLSearchParams([]);
            params.append('type', 'User.get_started_save_plan');
            params.append('params[plan_id]', this.activePlan.id);
            params.append('params[payment_type]', this.activePrice);
            this.handleRequest(params, '/api/create').then(data => {
                if (data.success && data.payment_url){
                    this.$alert(data.result).then(()=>{window.location.href = data.payment_url })
                } else if (data.success) {
                    this.$alert(data.result); window.location.href = './dashboard'
                }
            });
            this.handleRequest

            // window.location.href = '/plan-subscription/'+this.activePlan.id+'?duration='+this.activePrice;
        },

        /**
         * Send POST request
         * through the root method
         */
        async handleRequest(params, url = '/api') {
            return this.$root.$children[0].handleRequest(params, url);
        },


        /**
         * Translate into active language
         * through the root method
         */
        __(i) {
            return this.$root.$children[0].__(i);
        }


    }
};
</script>