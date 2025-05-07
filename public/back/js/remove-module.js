import { request } from './../../front/js/utils.js';

class RemoveManager {
    constructor() {
        
    }
    
    addListener(event)
    {
        document.querySelector("body").addEventListener("click", function(e){
            if(e.target.closest(".remove_button_action"))
            {
                Swal.fire({
                    title: "Do you really want to delete this record?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    confirmButtonColor: "red",
                }).then((result) => {
                    if (result.isConfirmed) {
                        const id = e.target.closest(".remove_button_action").closest("form").getAttribute('data-id')
                        event(id)
                    }
                })
            }
        })
    }   
}

export default new RemoveManager();