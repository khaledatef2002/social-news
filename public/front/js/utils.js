export const request = async function(url, method = "GET", data = {}) {
    const lang = document.querySelector('html').getAttribute('lang')

    if (method.toLowerCase() !== 'get' && method.toLowerCase() !== 'post') {
        if(data instanceof FormData)
        {
            data.append("_method", method.toUpperCase())
        }
        else
        {
            data["_method"] = method.toUpperCase()
        }
        method = "POST"
    }

    const options = {
        method: method,
        headers: {
            'Accept': 'application/json',
        }
    }

    if (method.toLowerCase() !== 'get') {
        if (data instanceof FormData) {
            options.body = data;
        } else {
            options.body = JSON.stringify(data);
            options.headers['Content-Type'] = 'application/json';
        }
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        options.headers['X-CSRF-TOKEN'] = csrfToken;
    }
    
    try {
        const response = await fetch(`/${lang}${url}`, options);
        const responseData = await response.json();

        if (!response.ok) {
            throw new Error(Object.values(responseData.errors).flat()[0] || "An unknown error occurred");
        }
        
        return {
            success: true,
            data: responseData
        };
    } catch (error) {
        return {
            success: false,
            message: error.message
        }
    }
}