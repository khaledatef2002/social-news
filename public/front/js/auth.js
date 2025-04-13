import { request } from './utils.js';

const page_lang = document.querySelector("html").getAttribute("lang")

const lang = await import("../libs/intl-tel-input/js/i18n/" + page_lang + "/index.js")

class AuthManager {
    constructor() {
        this.login_form = document.querySelector("form#login-form")
        if(this.login_form)
        {
            this.login_form.addEventListener("submit", this.login.bind(this))
            this.login_button = this.login_form.querySelector("[type='submit']")
        }

        this.register_form = document.querySelector("form#register-form")
        if(this.register_form)
        {
            this.register_form.addEventListener("submit", this.register.bind(this))
            this.register_button = this.register_form.querySelector("[type='submit']")

            this.iti = this.setup_iti()
        }

        
        this.forgot_password_form = document.querySelector("form#forgot-password-form")
        if(this.forgot_password_form)
        {
            this.forgot_password_form.addEventListener("submit", this.forgot_password.bind(this))
            this.forgot_password_button = this.forgot_password_form.querySelector("[type='submit']")

            this.iti = this.setup_iti()
        }

        
        this.reset_password_form = document.querySelector("form#password-reset-form")
        if(this.reset_password_form)
        {
            this.reset_password_form.addEventListener("submit", this.reset_password.bind(this))
            this.reset_password_button = this.reset_password_form.querySelector("[type='submit']")

            this.iti = this.setup_iti()
        }
    }
    async login(e) {
        e.preventDefault()
        this.login_button.setAttribute("disabled", "disabled")
        const formData = new FormData(this.login_form)
        const response = await request('/login', 'POST', formData)
        if(response.success) {
            window.location.reload()
        } else {
            this.show_error(response.message)
        }
        this.login_button.removeAttribute("disabled")
    }

    async register(e) {
        e.preventDefault()
        this.register_button.setAttribute("disabled", "disabled")

        const phone = this.iti.getNumber()
        const country_code = this.iti.getSelectedCountryData().iso2.toUpperCase()
        
        const formData = new FormData(this.register_form)
        formData.append("phone", phone)
        formData.append("country_code", country_code)

        const response = await request('/register', 'POST', formData)
        if(response.success) {
            window.location.href = ""
        } else {
            this.show_error(response.message)
        }
        this.register_button.removeAttribute("disabled")
    }

    async forgot_password(e) {
        e.preventDefault()
        this.forgot_password_button.setAttribute("disabled", "disabled")
        const formData = new FormData(this.forgot_password_form)
        const response = await request('/forgot-password', 'POST', formData)
        if(response.success) {
            this.forgot_password_form.querySelector("input[type='email']").value = ""
            this.show_success(response.data.message)
        } else {
            this.show_error(response.message)
        }
        this.forgot_password_button.removeAttribute("disabled")
    }

    async reset_password(e) {
        e.preventDefault()
        this.reset_password_button.setAttribute("disabled", "disabled")
        const formData = new FormData(this.reset_password_form)
        const response = await request('/reset-password', 'POST', formData)
        if(response.success) {
            this.reset_password_form.querySelector("input[type='email']").value = ""
            this.reset_password_form.querySelectorAll("input[type='password]']").forEach(input => input.value = "")
            this.show_success(response.data.message)
            location.href = "/login"
        } else {
            this.show_error(response.message)
        }
        this.reset_password_button.removeAttribute("disabled")
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

    setup_iti(){
        if(!this.register_form) return null

        return window.intlTelInput(this.register_form.querySelector("input.country-selector"), {
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
            loadUtils: () => import("../libs/intl-tel-input/js/utils.js"),
        });
    }
}

export default new AuthManager();