document.addEventListener("DOMContentLoaded", function (){
    const countryInput = document.getElementById("country");
    const result = document.getElementById("result");
    
    function search(lookup) {
            const country = countryInput.value.trim();
            let url = "world.php?country=" + encodeURIComponent(country);
            if (lookup) {
                url += "&lookup=" + lookup;
            }
            
            fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Request failed: " + response.status);
                }
                return response.text();
            })
            .then(html => {
                result.innerHTML = html;
            })
            .catch(error => {
                result.textContent = "Something went wrong: " + error.message;
            });
        }

        document.getElementById("lookup").addEventListener("click", function () {
            search("");
        });

        document.getElementById("lookup-cities").addEventListener("click", function () {
            search("cities");
        });
});