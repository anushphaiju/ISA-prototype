  async function weatherfind(city) {
    const apiKey = "afce25ec9cbca94dc81f34edc16fd77c";
    const apiURL = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`;
    let data;
    if (navigator.onLine) {
        try {
            const response = await fetch(apiURL);
            if (!response.ok) {
                console.error("Error");
                alert(`Error: ${response.status}. Please check city name.`);
                return;
            }
            data = await response.json();
            console.log("Weather data received:", data);
            localStorage.setItem("lastCity", city);
            localStorage.setItem(city, JSON.stringify(data));
            const phpURL = `https://anushphaiju.ct.ws/prototypee/connection.php?q=${city}`;
            fetch(phpURL).catch(err => console.warn("PHP not committed", err));
        } catch (error) {
            console.error(" Network Error:", error);
            return;
        }
    } else {
        const cached = localStorage.getItem(city);
        if (cached) data = JSON.parse(cached);
    }

    if (data) updateUI(data);
}
function updateUI(data) {
    document.querySelector("#city").innerHTML = data.name;
    document.querySelector("#fah").innerHTML = "Temperature"+data.main.temp+"°C";
    document.querySelector("#humidity").innerHTML = "Humidity"+data.main.humidity+"%";
    document.querySelector("#pressure").innerHTML = "Pressure" +data.main.pressure+"hPa";
    document.querySelector("#speed").innerHTML = "Windspeed"+data.wind.speed+"km/h";
    document.querySelector("#mainweather").innerHTML = "Weather"+data.weather[0].description;
    document.querySelector("#hii").innerHTML = data.weather[0].main;
}
weatherfind('biratnagar');
let input = document.getElementById("button");
  input.addEventListener("click", () => {
   let city = document.getElementById('searchBox').value;
   weatherfind(city);
  });