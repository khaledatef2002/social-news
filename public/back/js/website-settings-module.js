import { request } from './../../front/js/utils.js';

class WebsiteSettingManager {
    constructor() {
        document.querySelector("form#website-settings-change-form")?.addEventListener("submit", this.edit.bind(this))
        document.querySelector("#website-logo-change-form input[name='logo']")?.addEventListener("change", this.edit_logo.bind(this))
        document.querySelector("#website-banner-change-form input[name='banner']")?.addEventListener("change", this.edit_banner.bind(this))
    }


    async edit(e) {
        e.preventDefault()

        document.querySelector("button[type='submit").setAttribute("disabled", "disabled")
        
        const formData = new FormData(document.querySelector("form#website-settings-change-form"))

        const response = await request(`/dashboard/website_setting`, 'PUT', formData)
        if(response.success) {
            this.show_success(response.data.message)
        } else {
            this.show_error(response.message)
        }
        document.querySelector("button[type='submit").removeAttribute("disabled")
    }

    async edit_logo(e) {
        e.preventDefault()

        const formData = new FormData(document.querySelector("form#website-logo-change-form"))

        const response = await request(`/dashboard/website_setting/logo`, 'PUT', formData)
        if(response.success) {
            this.show_success(response.data.message)
        } else {
            this.show_error(response.message)
        }
    }

    async edit_banner(e) {
        e.preventDefault()

        const formData = new FormData(document.querySelector("form#website-banner-change-form"))

        const response = await request(`/dashboard/website_setting/banner`, 'PUT', formData)
        if(response.success) {
            this.show_success(response.data.message)
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

export default new WebsiteSettingManager();