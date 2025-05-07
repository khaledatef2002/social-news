import { request } from '../../front/js/utils.js';
import RemoveManager from './remove-module.js'

class TvArticleManager {
    constructor() {
        document.querySelector("form#create-tv-article-form")?.addEventListener("submit", this.add.bind(this))
        document.querySelector("form#edit-tv-article-form")?.addEventListener("submit", this.edit.bind(this))

        RemoveManager.addListener(this.remove.bind(this))
    }

    async add(e) {
        e.preventDefault()

        document.querySelector("button[type='submit").setAttribute("disabled", "disabled")
        
        const formData = new FormData(document.querySelector("form#create-tv-article-form"))

        const response = await request(`/dashboard/tv-articles`, 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
            window.location = response.data.url
        } else {
            this.show_error(response.message)
        }
        document.querySelector("button[type='submit").removeAttribute("disabled")
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

    async edit(e) {
        e.preventDefault()

        document.querySelector("button[type='submit").setAttribute("disabled", "disabled")

        const id = document.querySelector("#edit-tv-article-form").getAttribute("data-id")

        const formData = new FormData(document.querySelector("form#edit-tv-article-form"))

        const response = await request(`/dashboard/tv-articles/${id}`, 'PUT', formData)
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

export default new TvArticleManager();