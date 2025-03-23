"use strict";

import { WEATHER_API_KEY, WEATHER_API_URL } from './config.js'
import AuthController from './auth.js'

const loadSwiper = function(){
    const swiper1 = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
        direction: "vertical",
    });

    new Swiper(".mySwiper2", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper1,
        },
    });

    new Swiper(".swiper-section", {  
        slidesPerView: 3,
        spaceBetween: 40,
        autoplay: {
            delay: 5000,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        reverseDirection: true,
    })  
}


const get_geo_locations = function ()
{
    navigator.geolocation.getCurrentPosition(async (response) => {
        const {latitude, longitude} = response.coords
        const res = await fetch(`${WEATHER_API_URL}?key=${WEATHER_API_KEY}&q=${latitude},${longitude}`)
        const data = await res.json()
        const temp = data.current.temp_c
        document.querySelector("#click-for-location-permission").remove()
        document.querySelector(".weather-temp").textContent = `${temp} °C`
    }, (e) => {
        // alert(e.message)
    })
}

const navbar_intersect = function ()
{
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting)
            {
                document.querySelector(".navbar").classList.remove("floating-navbar")
            } else {
                document.querySelector(".navbar").classList.add("floating-navbar")
            }
        })
    }, {
        root: null,
        rootMargin: "0px",
        threshold: 0.1
    })

    observer.observe(document.querySelector(".weather_date"))
}

const fix_navbar_collapsing = function ()
{
    document.querySelector(".navbar-nav").addEventListener("click", (e) => {
        if(e.target.classList.contains("dropdown-toggle")) {
            e.preventDefault()
            e.target.parentElement.querySelector(".dropdown-menu").classList.toggle("show")
        }
        e.currentTarget.querySelectorAll(".dropdown-menu.show").forEach(menu => {
            if (menu !== e.target.parentElement.querySelector(".dropdown-menu")) {
                menu.classList.remove("show")
            }
        })
    })

    document.addEventListener("click", (e) => {
        if (!e.target.closest(".navbar-nav")) {
            document.querySelectorAll(".dropdown-menu.show").forEach(menu => {
                menu.classList.remove("show")
            })
        }
    })
    window.addEventListener("scroll", () => {
        document.querySelectorAll(".dropdown-menu.show").forEach(menu => {
            menu.classList.remove("show")
        })
    })
}

const language_menu = function ()
{
    document.querySelector("#lang_open").addEventListener("click", (e) => {
        e.preventDefault()
        e.currentTarget.parentElement.querySelector(".lang-menu").classList.toggle("show")
    })

    document.addEventListener("click", (e) => {
        if (!e.target.closest("#lang_open") && !e.target.closest(".lang-menu")) {
            document.querySelector(".lang-menu").classList.remove("show")
        }
    })

    document.addEventListener("scroll", (e) => {
        if (!e.target.closest("#lang_open") && !e.target.closest(".lang-menu")) {
            document.querySelector(".lang-menu").classList.remove("show")
        }
    })
}

const password_toggler = function()
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

const enable_input_image_selection = function()
{
    const fileInput = this.querySelector("input[type='file']");
    const preview = this.querySelector("img")
  
    fileInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
      } else {
      }
    });
}

function init()
{
    loadSwiper()
    get_geo_locations()
    document.querySelector("#click-for-location-permission").addEventListener("click", get_geo_locations)
    document.querySelectorAll(".password-toggler").forEach(e => e.addEventListener("click", password_toggler))
    navbar_intersect()
    fix_navbar_collapsing()
    language_menu()
    document.querySelectorAll("div.image-upload").forEach(e => enable_input_image_selection.bind(e)())
}

init()