import { request } from '../../front/js/utils.js';
import RemoveManager from './remove-module.js'

class TvArticleManager {
    constructor() {
        RemoveManager.addListener(this.remove.bind(this))
    }

    async remove(id)
    {
        const response = await request(`/dashboard/tv-articles/${id}`, 'DELETE')
        if(response.success) {
            this.show_success(response.data.message)
            table.ajax.reload(null, false)
        } else {
            this.show_error(response.message)
        }
    }

    show_success(message) {
        Swal.fire({
            title: "تم بنجاح",
            text: message,
            icon: "success"
        });         
    }

    show_error(message) {
        Swal.fire({
            title: "حدث خطاْ",
            text: message,
            icon: "error"
        });         
    }
}

export default new TvArticleManager();