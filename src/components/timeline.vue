<template>
    <div class="w-full overflow-auto" >

        <timeline v-if="events && events.length" :resources="projects" :events="events" :key="events" ></timeline>
        
    </div>
</template>
<script>
import {ref} from 'vue';
import moment from 'moment';
import {translate, formatDateTime, handleGetRequest, formatCustomTime, formatCustomTimeMinute} from '@/utils.vue';
import { Timeline } from "@teej/vue-timeline";
import "@teej/vue-timeline/dist/style.css";

export default 
{
    components:{
        Timeline
    },
    name:'timeline_page',
    setup(props) {

        const projects = ref();
        const events = ref();
        const content = ref();

        const getId = (projects, ip ) => {
            for (let i = 0; i < projects.length; i++) {
                const element = projects[i];
                if (element.name == ip) {
                    return element.id; 
                }
            }
            return 0
        }


        const load = () =>
        {
                
            handleGetRequest( props.conf.url+props.path+'?start_date='+event.startDate+'&end_date='+event.endDate+'&load=json' ).then(response=> {
                content.value = JSON.parse(JSON.stringify(response))
                
                if (content.value.visits_ip_list)
                {

                    projects.value = [];
                    for (let i = 0; i < content.value.visits_ip_list.length; i++) {
                        const element = content.value.visits_ip_list[i];
                        projects.value.push({ id: i+1, name: element.ip, color: '#f39c12' })
                    }

                    
                    events.value = [];
                    for (let i = 0; i < content.value.visits_list.length; i++) {
                        const element = content.value.visits_list[i];
                        const id = getId(projects.value, element.ip);
                        events.value.push({ id: i+1, resourceId: id, startDate: formatCustomTime(element.created_at, 'YYYY-MM-DD'), endDate: formatCustomTime(element.updated_at, 'YYYY-MM-DD'), name: (element && element.item) ? element.item.title : 'test'},)
                    }
                }
            });
        }
        load();
        
        return {
            projects,
            events,
            translate,
            
        }
    },
    props: [
        'conf',
        'path'
    ]
};
</script>