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
    }
    async login(e) {
        e.preventDefault()
        this.login_button.setAttribute("disabled", "disabled")
        const response = await request('/login', 'POST')
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

        const first_name = this.register_form.querySelector("input[name='first_name']").value
        const last_name = this.register_form.querySelector("input[name='last_name']").value
        const email = this.register_form.querySelector("input[name='email']").value
        const password = this.register_form.querySelector("input[name='password']").value
        const phone = this.iti.getNumber()
        const country_code = this.iti.getSelectedCountryData().iso2.toUpperCase()

        const response = await request('/register', 'POST', {first_name, last_name, email, password, phone, country_code})
        if(response.success) {
            window.location.reload()
        } else {
            this.show_error(response.message)
        }
        this.register_button.removeAttribute("disabled")
    }

    show_success() {
        window.location.reload()
    }

    show_error(message) {
        Swal.fire({
            title: "حدث خطاْ",
            text: message,
            icon: "error"
        });         
    }

    setup_iti(){
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