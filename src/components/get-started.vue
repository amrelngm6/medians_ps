<template>

    <div class="mx-auto w-3/4 py-8">
        <h2 class="text-xl" v-text="__('get_started_setting')"></h2>
        <p class="py-4 " v-text="__('complete_this_settings_to_start')"></p>
        <div class="mx-auto bg-white rounded-lg py-8 px-4 lg:flex " v-if="steps && !showLoader">
            
            <div class="w-1/3 ">
                <div v-for="step in steps" :key="step.active" class="w-full mb-4" >
                    <div :class="step.active ? '' : 'text-gray-300'" @click="setActiveStep(step.id)" class="cursor-pointer w-full flex ">
                        <span :class="step.active ? 'bg-blue-50' : ''"   class="block w-10 h-10 pt-2 text-center " v-text="step.id"></span>
                        <p class="block  mx-4">
                            <span class="block w-full font-semibold text-base" v-text="step.title"></span>
                            <span class="text-sm  " v-text="step.info"></span>
                        </p>
                    </div>
                    <div v-if="step.id < 3" class="mb-4">
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
                    <p class="text-lg font-semibold" v-text="__('Settings')" ></p>
                    <p class=" font-normal" v-text="__('important required settings')"></p>
                    <hr class="py-2 mt-4" />
                    <div class="relative py-4">
                        <label class="nui-label w-full pb-2 block font-semibold " for="ninja-input-89" v-text="__('Language')"></label>
                        <div class="group/nui-input relative">
                            <select name="params[settings][lang]" v-model="activeItem.lang" class="select h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600"><option value="english">English</option><option value="arabic">العربية</option></select>
                        </div>
                    </div>

                    <div class="w-full flex gap-6">
                        <div class="w-full relative py-4">
                            <label class="nui-label w-full pb-2 block font-semibold " for="ninja-input-89" v-text="__('Currency')"></label>
                            <div class="group/nui-input relative">
                                <input name="params[settings][currency]" v-model="activeItem.currency" type="text" :placeholder="__('Currency')" required="required" class="h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600">
                            </div>
                        </div>

                        <div class="w-full relative py-4">
                            <label class="nui-label w-full pb-2 block font-semibold " for="ninja-input-89" v-text="__('invoices_tax')"></label>
                            <div class="group/nui-input relative">
                                <input name="params[settings][tax]" v-model="activeItem.tax" type="number" :placeholder="__('invoices_tax')" required="required" class="h-10 mt-3 rounded w-full border px-3 text-gray-400 focus:border-blue-100 dark:bg-gray-800 dark:border-gray-600">
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
                    <p class="text-lg font-semibold" v-text="__('Review and confirm')"></p>
                    <p class=" font-normal" v-text="__('Review your information and confirm')">  </p>
                    <hr class="py-2 mt-4" />
                    <div class="block  w-full">


                         <div class="row justify-content-center">
                            <div class="col-lg-8">
                               <div class="payment__success__inner">
                                  <div class="payment__success__header">
                                     <div class="icon"><i class="material-symbols-outlined">done</i></div>
                                     <h2 v-text="__('thanks')"></h2>
                                     <p class="primary-text"> <span v-text="__('Activated your account successfully')"></span> <span v-text="__('thanks_for_activating_account')"></span></p>
                                  </div>
                                  <div class="payment__success__footer">
                                     <hr />
                                     <div class="mx-auto w-40 flex flex-end items-center gap-4 py-6">
                                        <button type="button" class="is-button rounded-lg bg-green-500 text-white h-12 w-full" @click="complete()" v-text="__('Confirm')"></button>
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

export default 
{
    name:'get-started',
    data() {
        return {
            showLoader:false,
            activeItem:{},
            activeStep:1,
            steps: [
                {id:1, title: this.__('Business information'), info:this.__('information about the branch'),active:1},
                {id:2, title: this.__('Settings'), info:this.__('important required settings'), active:0},
                {id:3, title: this.__('Review and confirm'), info:this.__('Review your information and confirm'), active:0}
            ],

        }
    },

    props: [
    ],
    mounted() 
    {
    },

    methods: 
    {
        /**
         * Switch between steps
         */
        setActiveStep(id)
        {
            this.showLoader = true
            for (var i = this.steps.length - 1; i >= 0; i--) {
                
                if(i && this.steps[i].id == id && this.steps[i-1] && this.steps[i-1].active  && this.steps[i].id ){
                    this.steps[i].active = true
                }

                if(this.steps[i] && this.steps[i].active && this.steps[i].id == id){

                    this.activeStep = this.steps[i].id
                }
            }
            this.showLoader = false
        },


        /**
         * Save branch name
         */
        saveBranch()
        {
            const params = new URLSearchParams([]);
            params.append('type', 'User.get_started_save_branch');
            params.append('params[name]', this.activeItem.branch_name);
            this.handleRequest(params,'/api/create').then(data => { 
                data.error ? this.$alert(data.error) : ''
                data.success ? this.setActiveStep(2) : ''
            });
        },

        /**
         * Save branch name
         */
        saveSetting()
        {
            const params = new URLSearchParams([]);
            params.append('type', 'User.get_started_save_setting');
            params.append('params[settings][sitename]', this.activeItem.branch_name);
            params.append('params[settings][lang]', this.activeItem.lang);
            params.append('params[settings][currency]', this.activeItem.currency);
            params.append('params[settings][tax]', this.activeItem.tax);
            this.handleRequest(params,'/api/create').then(data => { 
                this.$alert(data.error ? data.error : data.result)
                data.success ? this.setActiveStep(3) : ''
            });
        },

        /**
         * Complete and go start
         * 
         */
        complete()
        {
            if (this.activeItem.branch_name)
                window.location.href = '/dashboard'
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
        __(i)
        {
            return this.$root.$children[0].__(i);
        }   


    }
};
</script>