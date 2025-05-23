import { request } from '../../front/js/utils.js';
import RemoveManager from './remove-module.js'

class AdManager {
    constructor() {
        document.querySelector("form#create-ad-form")?.addEventListener("submit", this.create.bind(this))
        document.querySelector("form#edit-ad-form")?.addEventListener("submit", this.edit.bind(this))
        
        RemoveManager.addListener(this.remove.bind(this))
    }

    async remove(id)
    {
        const response = await request(`/dashboard/ads/${id}`, 'DELETE')
        if(response.success) {
            this.show_success(response.data.message)
            table.ajax.reload(null, false)
        } else {
            this.show_error(response.message)
        }
    }

    async create(e) {
        e.preventDefault()
        document.querySelector("button[type='submit").setAttribute("disabled", "disabled")
        
        const formData = new FormData(document.querySelector("form#create-ad-form"))

        const response = await request('/dashboard/ads', 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
            document.querySelectorAll("input").forEach(input => input.value = "")
            document.querySelectorAll("#product-img").forEach(img => img.src = "")

            $('select[name="pages[]"]').val(null).trigger('changes');
            $('select[name="articles_categories[]"]').val(null).trigger('changes');
            $('select[name="media_categories[]"]').val(null).trigger('changes');
        } else {
            this.show_error(response.message)
        }
        document.querySelector("button[type='submit").removeAttribute("disabled")
    }

    async edit(e) {
        e.preventDefault()

        const user_id = document.querySelector("form#edit-ad-form").getAttribute("data-id")

        document.querySelector("button[type='submit").setAttribute("disabled", "disabled")
        
        const formData = new FormData(document.querySelector("form#edit-ad-form"))

        const response = await request(`/dashboard/ads/${user_id}`, 'PUT', formData)
        if(response.success) {
            this.show_success(response.data.message)
        } else {
            this.show_error(response.message)
        }
        document.querySelector("button[type='submit").removeAttribute("disabled")
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

export default new AdManager();