import { request } from '../../front/js/utils.js';
import RemoveManager from './remove-module.js'

class AdManager {
    constructor() {
        document.querySelector("form#create-ad-form")?.addEventListener("submit", this.create.bind(this))
        document.querySelector("form#edit-ad-form")?.addEventListener("submit", this.edit.bind(this))
        
        RemoveManager.addListener(this.remove.bind(this))

        document.querySelectorAll("form input[name='is_counted']")
                .forEach(input => input.addEventListener("change", this.is_counted_switcher.bind(this)))

        document.querySelectorAll("form input[name='is_start_date']")
                .forEach(input => input.addEventListener("change", this.is_start_date_switcher.bind(this)))

        document.querySelectorAll("form input[name='is_end_date']")
                .forEach(input => input.addEventListener("change", this.is_end_date_switcher.bind(this)))
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

    is_end_date_switcher(e) {
        const is_end_date = e.target.checked
        if(is_end_date) {
            document.querySelector("div:has( > input[name='end_date'])").classList.remove("d-none")
        } else {
            document.querySelector("div:has( > input[name='end_date'])").classList.add("d-none")
            document.querySelector("div:has( > input[name='end_date'])").querySelector("input").value = ""
        }
    }

    is_start_date_switcher(e) {
        const is_start_date = e.target.checked
        if(is_start_date) {
            document.querySelector("div:has( > input[name='start_date'])").classList.remove("d-none")
        } else {
            document.querySelector("div:has( > input[name='start_date'])").classList.add("d-none")
            document.querySelector("div:has( > input[name='start_date'])").querySelector("input").value = ""
        }
    }

    is_counted_switcher(e) {
        const is_counted = e.target.checked
        if(is_counted) {
            document.querySelector("div:has( > input[name='max_views'])").classList.remove("d-none")
        } else {
            document.querySelector("div:has( > input[name='max_views'])").classList.add("d-none")
        }
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