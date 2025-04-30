import { request } from './utils.js';

const page_lang = document.querySelector("html").getAttribute("lang")

const lang = await import("../libs/intl-tel-input/js/i18n/" + page_lang + "/index.js")

class ProfileManager {
    constructor() {
        this.edit_profile_form = document.querySelector("form#edit-profile")
        if(this.edit_profile_form)
        {
            this.edit_profile_form.addEventListener("submit", this.edit_profile.bind(this))
            this.edit_profile_button = this.edit_profile_form.querySelector("[type='submit']")

            this.iti = this.setup_iti()
        }
    }
    
    async edit_profile(e)
    {
        e.preventDefault()
        const profile_id = this.edit_profile_form.getAttribute("data-id")

        const phone = this.iti.getNumber()
        const country_code = this.iti.getSelectedCountryData().iso2.toUpperCase()

        this.edit_profile_button.setAttribute("disabled", "disabled")
        const formData = new FormData(this.edit_profile_form)
        formData.append("phone", phone)
        formData.append("country_code", country_code)

        const response = await request(`/profile/${profile_id}`, 'PUT', formData)
        if(response.success) {
            this.show_success(response.data.message)
        } else {
            this.show_error(response.message)
        }
        this.edit_profile_button.removeAttribute("disabled")
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
        if(!this.edit_profile_form) return null

        return window.intlTelInput(this.edit_profile_form.querySelector("input.country-selector"), {
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

export default new ProfileManager();