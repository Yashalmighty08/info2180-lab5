document.addEventListener("DOMContentLoaded", function (){
    const countryInput = document.getElementById("country");
    const result = document.getElementById("result");

    document.getElementById("lookup").addEventListener("click", function () {
        const country = countryInput.value.trim();

        fetch("world.php?country=" + encodeURIComponent(country))
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

    });
});