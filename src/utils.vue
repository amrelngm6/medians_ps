<script>
import moment from 'moment';
import axios from 'axios'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export function formatDate(date) {
  return moment(date).format('YYYY-MM-DD');
}

export function formatDateTime(date) {
  return moment(date).format('YYYY-MM-DD HH:mm a');
}


export function remove(item, type) {
            
    if (!window.confirm(this.__('confirm_delete')))
    {
        return null;
    }

    var params = new URLSearchParams();
    params.append('type', type)
    params.append('params[id]', item.id)
    handleRequest(params, '/api/delete').then(response => {
        this.$alert(response.result).then(() => {
            if (response && response.reload)
            {
                location.reload();
            }
        })
    })
}

export function deleteByKey(itemKey, itemValue, type) {
    
    if (!window.confirm(translate('confirm_delete')))
    {
        return null;
    }

    var params = new URLSearchParams();
    params.append('type', type)
    params.append('params['+itemKey+']', itemValue[itemKey])
    handleRequest(params, '/api/delete').then(response => {
        showAlert(response.result);
        setTimeout(() => {
            if (response && response.reload){
                location.reload();
            }
        }, 2000);

    })
}

export async function handleGetRequest(url) {
    return await axios.get(url).then(response => {
        if (response.data.status)
            return response.data.result ? response.data.result : response.data;
        else
            return response.data;
    });
}

export async function handleRequest(params, url = '/api') {
  return await axios.post(url, params.toString()).then(response => {
      return response.data;
  });
}

export function translate(i) {
    let key = i.toLowerCase().replaceAll(' ', '_');
    let k = i.replaceAll('_', ' ');
    let un_key = k.charAt(0).toUpperCase() + k.slice(1);

    let langEle = document.getElementById('root-parent');
    let lang = $(langEle).data('lang');
    return lang[key] ? lang[key] : un_key;
}

export function showAlert(response,duration = 3000)
{
    toast(response, {
        position: toast.POSITION.TOP_CENTER,
        autoClose: duration,
    });
}

</script>