import { request } from './utils.js';

class TvArticlesManager {
    constructor() {
        this.Limit = 20

        this.getingTvArticlesLoader = document.querySelector(".getingTvArticlesLoader")

        this.tv_articles_container = document.querySelector("main.tv_articles")
        if(this.tv_articles_container)
        {
            this.display_tv_articles()
        }

        this.get_tv_articles_working = false
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

    async display_tv_articles() {
        window.addEventListener('scroll', async () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200 && !this.get_tv_articles_working) {
                await this.get_tv_articles()
            }
        });
    }

    async get_tv_articles()
    {
        this.get_tv_articles_working = true
        this.getingTvArticlesLoader.style.display = "flex"
        const url = `tv-articles/${LastTvArticleId}/${this.Limit}`
        const result = await request(url)

        if(result.success)
        {
            LastTvArticleId = result.data.last_tv_article_id
            this.getingTvArticlesLoader.insertAdjacentHTML('beforebegin', result.data.content)
            this.getingTvArticlesLoader.style.display = "none"
            this.get_tv_articles_working = false
        }
        else
        {

            this.getingTvArticlesLoader.innerHTML = `<p class="fw-bold mb-0 fs-5">لا يوجد نتائج اخرى</p>`
        }
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

export default new TvArticlesManager();