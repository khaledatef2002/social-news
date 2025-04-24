import { request } from './utils.js';

class ArticlesManager {
    constructor() {
        this.Limit = 20

        this.getingArticlesLoader = document.querySelector(".getingArticlesLoader")

        this.create_article_form = document.querySelector("form#create-article-form")
        if(this.create_article_form)
        {
            this.create_article_form.addEventListener("submit", this.create_article.bind(this))
            this.create_article_button = this.create_article_form.querySelector("[type='submit']")
        }

        this.edit_article_form = document.querySelector("form#edit-article-form")
        if(this.edit_article_form)
        {
            this.edit_article_form.addEventListener("submit", this.edit_article.bind(this))
            this.edit_article_button = this.edit_article_form.querySelector("[type='submit']")
        }

        this.articles_container = document.querySelector("main.articles")
        if(this.articles_container)
        {
            this.display_articles()
        }

        this.get_articles_working = false

        document.querySelector("body").addEventListener('click', async (e) => {
            if(e.target.classList.contains('remove_article'))
            {
                this.remove_article(e.target.closest('article'), e.target.closest('article').getAttribute('data-article-id'))
            }

            const heartButton = e.target.closest('.heart_action_button');
            const articleElement = e.target.closest('article');
            if (heartButton && articleElement) {
                this.send_react(heartButton, articleElement.getAttribute('data-article-id'));
            }

            if(e.target.closest('.user_save_article_action'))
            {
                this.bookmark_article(e.target.closest('.user_save_article_action'), e.target.closest('article').getAttribute('data-article-id'))
            }
        })
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

    async edit_article(e)
    {
        e.preventDefault()
        const article_id = this.edit_article_form.getAttribute("data-id")

        this.edit_article_button.setAttribute("disabled", "disabled")
        const formData = new FormData(this.edit_article_form)

        images.forEach(image => {
            formData.append("images[]", image.id)
        });
        const response = await request(`/articles/${article_id}`, 'PUT', formData)
        if(response.success) {
            this.show_success(response.data.message)
        } else {
            this.show_error(response.message)
        }
        this.edit_article_button.removeAttribute("disabled")
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

    async display_articles() {
        window.addEventListener('scroll', async () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200 && !this.get_articles_working) {
                await this.get_articles()
            }
        });
    }

    async get_articles()
    {
        this.get_articles_working = true
        this.getingArticlesLoader.style.display = "flex"
        const url = Type == "article" ? `articles/${LastArticleId}/${this.Limit}` : `articles_summary/${LastArticleId}/${this.Limit}`
        const result = await request(url)

        if(result.success)
        {
            LastArticleId = result.data.last_article_id
            this.getingArticlesLoader.insertAdjacentHTML('beforebegin', result.data.content)
            this.getingArticlesLoader.style.display = "none"
            this.get_articles_working = false
        }
        else
        {

            this.getingArticlesLoader.innerHTML = `<p class="fw-bold mb-0 fs-5">لا يوجد نتائج اخرى</p>`
        }
    }

    async send_react(button, article_id)
    {
        button.disabled = true
        const result = await request(`/articles/${article_id}/react`, "POST")

        if(result.success)
        {
            if(result.data.reacted)
            {
                button.innerHTML = `
                    <i class="fas fa-heart"></i>
                    أحببته
                `
                button.classList.add("reacted")
            }
            else
            {
                button.innerHTML = `
                    <i class="far fa-heart"></i>
                    أحببته
                `
                button.classList.remove("reacted")
            }
            button.parentElement.querySelector('.count').textContent = result.data.count
        }
        else
        {
            this.show_error(result.message)
        }
        button.disabled = false
    }

    async bookmark_article(button, article_id)
    {
        const result = await request(`/articles/${article_id}/bookmark`, "POST")

        if(result.success)
        {
            if(result.data.bookmarked)
            {
                button.innerHTML = `
                   <i class="fas fa-bookmark"></i> إزالة من المفضلات
                `
                button.classList.add("saved")
            }
            else
            {
                button.innerHTML = `
                    <i class="far fa-bookmark"></i> حفظ في المفضلات
                `
                button.classList.remove("saved")
            }
            this.show_toastify(result.data.message, 'success')
        }
        else
        {
            this.show_toastify(result.data.message, 'error')
        }
    }

    async remove_article(article_element, article_id)
    {
        Swal.fire({
            title: "هل انت متأكد من رغبتك في حزف هذه المقالة؟",
            text: "لن تسطيع استعادتها مرة اخرى",
            showCancelButton: true,
            confirmButtonText: "حزف",
            cancelButtonText: `تراجع`,
        }).then(async (result) => {
            if (result.isConfirmed) {
                const result = await request(`articles/${article_id}`, "DELETE")
                if(result.success)
                {
                    article_element.remove()
                    this.show_success(result.data.message)
                }
                else
                {
                    this.show_error(result.message)
                }
            }
        }); 
    }

    show_toastify(text, type)
    {
        const background = type == 'error' ? '#c0392b' : '#27ae60' 
        Toastify({
            text: text,
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "left",
            stopOnFocus: true,
            style: {
                background,
            },
        }).showToast();
    }
}

export default new ArticlesManager();