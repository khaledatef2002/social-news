import { request } from '../../front/js/utils.js';
import RemoveManager from './remove-module.js'

class WriterRequestsyManager {
    constructor() {
        
        document.querySelector("body").addEventListener("click", (e) => {
            if(e.target.closest(".approve"))
            {
                const id = e.target.closest(".approve").getAttribute("data-id")
                this.approve.bind(this)(id)
            }
            if(e.target.closest(".reject"))
            {
                const id = e.target.closest(".reject").getAttribute("data-id")
                this.reject.bind(this)(id)
            }
        })

        RemoveManager.addListener(this.remove.bind(this))
    }

    async approve(id)
    {
        const response = await request(`/dashboard/writer-request/${id}/approve`, 'PUT')

        if(response.success) {
            this.show_success(response.data.message)
            table.ajax.reload(null, false)
        } else {
            this.show_error(response.message)
        }
    }

    async reject(id)
    {
        const response = await request(`/dashboard/writer-request/${id}/reject`, 'PUT')

        if(response.success) {
            this.show_success(response.data.message)
            table.ajax.reload(null, false)
        } else {
            this.show_error(response.message)
        }
    }

    // async add(e) {
    //     e.preventDefault()

    //     document.querySelector("button[type='submit").setAttribute("disabled", "disabled")
        
    //     const formData = new FormData(document.querySelector("form#add-article-category-form"))

    //     const response = await request(`/dashboard/articles-categories`, 'POST', formData)
    //     if(response.success) {
    //         this.show_success(response.data.message)
    //         table.ajax.reload(null, false)
    //         this.add_modal.hide()
    //     } else {
    //         this.show_error(response.message)
    //     }
    //     document.querySelector("button[type='submit").removeAttribute("disabled")
    // }

    async remove(id)
    {
        const response = await request(`/dashboard/writer-request/${id}`, 'DELETE')
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

export default new WriterRequestsyManager();