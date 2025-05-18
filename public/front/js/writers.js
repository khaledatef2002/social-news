import { request } from './utils.js';

class WritersManager {
    constructor() {
        this.Limit = 20

        this.gettingWritersLoader = document.querySelector(".gettingWritersLoader")
        this.search_box = document.querySelector('input[name="search"]')


        this.writers_container = document.querySelector("main.writers")
        if(this.writers_container)
        {
            this.display_writers()
        }

        this.search_box.addEventListener('input', async () => {
            if(this.timer) clearTimeout(this.timer)
            this.timer = setTimeout(async () => {
                await this.search()
            }, 500)
        })

        this.getting_writers_working = false

        this.timer = null
    }

    async display_writers() {
        window.addEventListener('scroll', async () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200 && !this.getting_writers_working) {
                await this.get_writers()
            }
        });
    }

    async search()
    {
        this.gettingWritersLoader.classList.remove('d-none')

        this.gettingWritersLoader.style.display = "flex"
        
        let url = `/writers/search?search=${this.search_box.value}`
        const result = await request(url)

        if(result.success)
        {
            LastWriterId = result.data.last_writer_id
            document.querySelector('main.writers > .row').innerHTML = result.data.content
            this.gettingWritersLoader.style.display = "none"
            this.getting_writers_working = false
        }
        else
        {
            document.querySelector('main.writers > .row').innerHTML = `<p class="fw-bold mb-0 fs-5 text-center mt-4">لا يوجد نتائج اخرى</p>`
            this.gettingWritersLoader.classList.add('d-none')
        }
    }

    async get_writers()
    {
        this.getting_writers_working = true
        this.gettingWritersLoader.style.display = "flex"
        let url = `/writers/${LastWriterId}/${this.Limit}`

        const search = this.search_box.value
        if(search)
        {
            url += `?search=${search}`
        }

        const result = await request(url)

        if(result.success)
        {
            LastWriterId = result.data.last_writer_id
            this.gettingWritersLoader.insertAdjacentHTML('beforebegin', result.data.content)
            this.gettingWritersLoader.style.display = "none"
            this.getting_writers_working = false
        }
        else
        {
            this.gettingWritersLoader.classList.add('d-none')
            this.gettingWritersLoader.insertAdjacentHTML('beforebegin',`<p class="fw-bold mb-0 fs-5 text-center mt-4">لا يوجد نتائج اخرى</p>`)
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

export default new WritersManager();