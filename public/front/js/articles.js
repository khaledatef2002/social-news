import { request } from './utils.js';

class ArticlesManager {
    constructor() {
        this.create_article_form = document.querySelector("form#create-article-form")
        if(this.create_article_form)
        {
            this.create_article_form.addEventListener("submit", this.create_article.bind(this))
            this.create_article_button = this.create_article_form.querySelector("[type='submit']")
        }
    }
    
    async create_article(e)
    {
        e.preventDefault()
        this.create_article_button.setAttribute("disabled", "disabled")
        const formData = new FormData(this.create_article_form)
        images.forEach(image => {
            formData.append("images[]", image.id)
        });
        const response = await request('/articles', 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
            location.href = response.data.url
        } else {
            this.show_error(response.message)
        }
        this.create_article_button.removeAttribute("disabled")
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

export default new ArticlesManager();