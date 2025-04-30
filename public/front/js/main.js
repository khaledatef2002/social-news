"use strict";

import AuthController from './auth.js'
import ArticlesController from './articles.js'
import TvArticlesController from './tv_articles.js'
import ProfileController from './profile.js'


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
        document.querySelector("#dark_mood_button").classList.add("fa-moon")
        document.querySelector("#dark_mood_button").classList.remove("fa-sun")
    } else {
        document.querySelector("body").classList.add("dark-mode")
        localStorage.setItem("dark_mode", "true")
        document.querySelector("#dark_mood_button").classList.add("fa-sun")
        document.querySelector("#dark_mood_button").classList.remove("fa-moon")
    }
}

const allow_image_input_file_display = function()
{
    document.querySelectorAll(".auto-image-show").forEach(e => {
        const fileInput = e.querySelector("input[type='file']");
        const preview = e.querySelector("img")
    
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
    })
}

const enable_tool_top = function()
{
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
}

function init()
{
    allow_image_input_file_display()
    document.querySelectorAll(".password-toggler").forEach(e => e.addEventListener("click", password_toggler))
    // navbar_intersect()
    dark_mode_init()
    document.querySelectorAll("div.image-upload").forEach(e => enable_input_image_selection.bind(e)())
    enable_tool_top()
}

init()