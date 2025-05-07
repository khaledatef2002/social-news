import { request } from '../../front/js/utils.js';
import RemoveManager from './remove-module.js'

class ArticleCategoryManager {
    constructor() {
        document.querySelector("form#add-article-category-form")?.addEventListener("submit", this.add.bind(this))
        document.querySelector("form#edit-article-category-form")?.addEventListener("submit", this.edit.bind(this))
        
        if(document.getElementById('addArticleCategoryModal'))
        {
            this.add_modal = new bootstrap.Modal(document.getElementById('addArticleCategoryModal'))
        }

        if(document.getElementById('editArticleCategoryModal'))
        {
            this.edit_modal = new bootstrap.Modal(document.getElementById('editArticleCategoryModal'))
        }
        
        document.querySelector("body").addEventListener("click", (e) => {
            if(e.target.closest(".openEditCategory"))
            {
                const id = e.target.closest(".openEditCategory").getAttribute("data-id")
                this.open_edit_category_modal.bind(this)(id)
            }
        })

        RemoveManager.addListener(this.remove.bind(this))
    }

    async add(e) {
        e.preventDefault()

        document.querySelector("button[type='submit").setAttribute("disabled", "disabled")
        
        const formData = new FormData(document.querySelector("form#add-article-category-form"))

        const response = await request(`/dashboard/articles-categories`, 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
            table.ajax.reload(null, false)
            this.add_modal.hide()
        } else {
            this.show_error(response.message)
        }
        document.querySelector("button[type='submit").removeAttribute("disabled")
    }

    async remove(id)
    {
        const response = await request(`/dashboard/articles-categories/${id}`, 'DELETE')
        if(response.success) {
            this.show_success(response.data.message)
            table.ajax.reload(null, false)
        } else {
            this.show_error(response.message)
        }
    }

    async open_edit_category_modal(id)
    {
        const response = await request(`/dashboard/articles-categories/${id}/edit`)
        if(response.success) {
            this.edit_modal.show()
            response.data.category.translations.forEach(translation => {
                document.querySelector(`#editArticleCategoryModal form input[name='${translation.locale}[title]']`).value = translation.title
            })

            document.querySelector("#editArticleCategoryModal").setAttribute("data-id", id)
        } else {
            this.show_error(response.message)
        }
    }

    async edit(e) {
        e.preventDefault()

        document.querySelector("button[type='submit").setAttribute("disabled", "disabled")
        

        const id = document.querySelector("#editArticleCategoryModal").getAttribute("data-id")

        const formData = new FormData(document.querySelector("form#edit-article-category-form"))

        const response = await request(`/dashboard/articles-categories/${id}`, 'PUT', formData)
        if(response.success) {
            this.show_success(response.data.message)
            this.edit_modal.hide()
            table.ajax.reload(null, false)
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

export default new ArticleCategoryManager();