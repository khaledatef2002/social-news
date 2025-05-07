import { request } from '../../front/js/utils.js';
import RemoveManager from './remove-module.js'

class RolesManager {
    constructor() {
        document.querySelector("form#create-role-form")?.addEventListener("submit", this.add.bind(this))
        document.querySelector("form#edit-role-form")?.addEventListener("submit", this.edit.bind(this))

        RemoveManager.addListener(this.remove.bind(this))
    }
    async add(e) {
        e.preventDefault()

        document.querySelector("button[type='submit").setAttribute("disabled", "disabled")
        
        const formData = new FormData(document.querySelector("form#create-role-form"))

        const response = await request(`/dashboard/roles`, 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
            window.location = response.data.url
        } else {
            this.show_error(response.message)
        }
        document.querySelector("button[type='submit").removeAttribute("disabled")
    }

    async edit(e) {
        e.preventDefault()

        document.querySelector("button[type='submit").setAttribute("disabled", "disabled")

        const id = document.querySelector("#edit-role-form").getAttribute("data-id")

        const formData = new FormData(document.querySelector("form#edit-role-form"))

        const response = await request(`/dashboard/roles/${id}`, 'PUT', formData)
        if(response.success) {
            this.show_success(response.data.message)
        } else {
            this.show_error(response.message)
        }
        document.querySelector("button[type='submit").removeAttribute("disabled")
    }

    async remove(id)
    {
        const response = await request(`/dashboard/roles/${id}`, 'DELETE')
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

export default new RolesManager();