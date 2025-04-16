import { request } from './utils.js';

class ArticlesManager {
    constructor() {
        this.getingArticlesLoader = document.querySelector(".getingArticlesLoader")

        this.create_article_form = document.querySelector("form#create-article-form")
        if(this.create_article_form)
        {
            this.create_article_form.addEventListener("submit", this.create_article.bind(this))
            this.create_article_button = this.create_article_form.querySelector("[type='submit']")
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
                this.remove_article(e.target.closest('article'), e.target.getAttribute('data-article-slug'))
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
                await this.get_articles(MainOffset + 10)
            }
        });
    }

    async get_articles(offset = 0, limit = 10)
    {
        this.get_articles_working = true
        this.getingArticlesLoader.style.display = "flex"
        const result = await request(`articles/${offset}/${limit}`)

        console.log(result)

        if(result.success)
        {
            MainOffset += Number(result.data.length)
            this.getingArticlesLoader.insertAdjacentHTML('beforebegin', result.data.content)
            this.getingArticlesLoader.style.display = "none"
            this.get_articles_working = false
        }
        else
        {

            this.getingArticlesLoader.innerHTML = `<p class="fw-bold mb-0 fs-5">لا يوجد نتائج اخرى</p>`
        }
    }

    async remove_article(article_element, article_slug)
    {
        Swal.fire({
            title: "هل انت متأكد من رغبتك في حزف هذه المقالة؟",
            text: "لن تسطيع استعادتها مرة اخرى",
            showCancelButton: true,
            confirmButtonText: "حزف",
            cancelButtonText: `تراجع`,
        }).then(async (result) => {
            if (result.isConfirmed) {
                const result = await request(`articles/${article_slug}`, "DELETE")
                if(result.success)
                {
                    MainOffset -= 1
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
}

export default new ArticlesManager();