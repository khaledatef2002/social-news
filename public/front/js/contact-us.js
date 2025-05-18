import { request } from './utils.js';

class ContactUsManager {
    constructor() {
        this.contact_us_form = document.querySelector("form#contact-us-form")
        if(this.contact_us_form)
        {
            this.contact_us_form.addEventListener("submit", this.send.bind(this))
            this.contact_us_button = this.contact_us_form.querySelector("[type='submit']")
        }
    }
    async send(e) {
        e.preventDefault()
        this.contact_us_button.setAttribute("disabled", "disabled")
        const formData = new FormData(this.contact_us_form)
        const response = await request('/contact-us', 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
            this.contact_us_form.querySelectorAll("input").forEach(input => input.value = '')
            this.contact_us_form.querySelector("textarea").value = ''
        } else {
            this.show_error(response.message)
        }
        this.contact_us_button.removeAttribute("disabled")
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

export default new ContactUsManager();