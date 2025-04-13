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

const dark_mode_init = function()
{
    dark_mode_toggler(localStorage.getItem("dark_mode") == "true" ? "false" : "true")

    document.querySelector("#dark_mood_button").addEventListener("click", () => dark_mode_toggler(localStorage.getItem("dark_mode")))
}

const dark_mode_toggler = function(dark_mode)
{
    if (dark_mode == "true")
    {
        document.querySelector("body").classList.remove("dark-mode")
        localStorage.setItem("dark_mode", "false")
        document.querySelector("#dark_mood_button").classList.remove("fa-moon")
        document.querySelector("#dark_mood_button").classList.add("fa-sun")
    } else {
        document.querySelector("body").classList.add("dark-mode")
        localStorage.setItem("dark_mode", "true")
        document.querySelector("#dark_mood_button").classList.remove("fa-sun")
        document.querySelector("#dark_mood_button").classList.add("fa-moon")
    }
}


function init()
{
    loadSwiper()
    get_geo_locations()
    document.querySelector("#click-for-location-permission").addEventListener("click", get_geo_locations)
    document.querySelectorAll(".password-toggler").forEach(e => e.addEventListener("click", password_toggler))
    navbar_intersect()
    dark_mode_init()
    document.querySelectorAll("div.image-upload").forEach(e => enable_input_image_selection.bind(e)())
}

init()