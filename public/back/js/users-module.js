import { request } from './../../front/js/utils.js';
import RemoveManager from './remove-module.js'

const page_lang = document.querySelector("html").getAttribute("lang")

const lang = await import("./../../front/libs/intl-tel-input/js/i18n/" + page_lang + "/index.js")

class UsersManager {
    constructor() {
        this.iti = this.setup_iti()
        document.querySelectorAll(".password-toggler").forEach(e => e.addEventListener("click", this.password_toggler))
        document.querySelector("form#create-user-form")?.addEventListener("submit", this.create.bind(this))
        document.querySelector("form#edit-user-form")?.addEventListener("submit", this.edit.bind(this))
        
        RemoveManager.addListener(this.remove.bind(this))

        console.log(document.querySelector("input[name='admin']"))

        document.querySelectorAll("input[name='admin']").forEach(input => input.addEventListener("change", this.admin_switcher.bind(input)))
    }

    admin_switcher(e)
    {
        const status = this.checked;
        console.log(this)
        
        const roleSelect = document.querySelector("select[name='role']");
    
        const container = roleSelect?.closest("div");
    
        if (container) {
            container.style.display = status ? "block" : "none";
        }
    }

    async remove(id)
    {
        const response = await request(`/dashboard/users/${id}`, 'DELETE')
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

        const phone = this.iti.getNumber()
        const country_code = this.iti.getSelectedCountryData().iso2.toUpperCase()
        
        const formData = new FormData(document.querySelector("form#create-user-form"))
        formData.append("phone", phone)
        formData.append("country_code", country_code)

        const response = await request('/dashboard/users', 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
            document.querySelectorAll("input").forEach(input => input.value = "")
            document.querySelectorAll("#product-img").forEach(img => img.src = "")
            this.iti.reset()
            document.querySelectorAll("input[type='checkbox']").forEach(input => input.checked = false)
            document.querySelectorAll("select").forEach(input => input.value = input.options[0].value)
        } else {
            this.show_error(response.message)
        }
        document.querySelector("button[type='submit").removeAttribute("disabled")
    }

    async edit(e) {
        e.preventDefault()

        const user_id = document.querySelector("form#edit-user-form").getAttribute("data-id")

        document.querySelector("button[type='submit").setAttribute("disabled", "disabled")

        const phone = this.iti.getNumber()
        const country_code = this.iti.getSelectedCountryData().iso2.toUpperCase()
        
        const formData = new FormData(document.querySelector("form#edit-user-form"))
        formData.append("phone", phone)
        formData.append("country_code", country_code)

        const response = await request(`/dashboard/users/${user_id}`, 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
        } else {
            this.show_error(response.message)
        }
        document.querySelector("button[type='submit").removeAttribute("disabled")
    }

    password_toggler()
    {
        const input = this.parentElement.querySelector("input")
        if(input.getAttribute("type") == "password")
        {
            this.classList.remove("fa-eye")
            this.classList.add("fa-eye-slash")
            input.setAttribute("type", "text")
        }
        else
        {
            this.classList.add("fa-eye")
            this.classList.remove("fa-eye-slash")
            input.setAttribute("type", "password")
        }

    }



    setup_iti(){
        if(!document.querySelector("input.country-selector")) return null
        return window.intlTelInput(document.querySelector("input.country-selector"), {
            i18n: lang,
            initialCountry: "auto",
            geoIpLookup: callback => {
                fetch("https://ipapi.co/json")
                    .then(res => res.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback("UAE"));
            },
            strictMode: true,
            separateDialCode: true,
            allowDropdown: true,
            autoPlaceholder: "aggressive",
            hiddenInput: (telInputName) => ({
                phone: "phone_numer",
                country: "country_code"
            }),
            loadUtils: () => import("../../front/libs/intl-tel-input/js/utils.js"),
        });
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

export default new UsersManager();