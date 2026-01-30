 async function weather(cityname){
  fetch(`http://localhost/prototypee/connection.php`);
    .then(result=>result.json())
    .then(output=>console.log(output));
 }weather(cityname);
 async function weatherfind(city){
    const result=await result.json()
    console.log(result)
    const response=await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&APPID=afce25ec9cbca94dc81f34edc16fd77c`);
    const data=await response.json();
    console.log(data);
    document.querySelector("#city").innerHTML=data.name;
    document.querySelector("#fah").innerHTML="Temperature:"+data.main.temp+"°C";
    document.querySelector("#humidity").innerHTML= "Humidity:" +data.main.humidity+"%";
    document.querySelector("#pressure").innerHTML= "pressure:"+data.main.pressure+"hPa";
    document.querySelector("#speed").innerHTML="windspeed:"+data.wind.speed+"km/h";
    document.querySelector("#mainwaether").innerHTML="Main weather:"+data.weather[0].description;
    document.querySelector("#aaa"),innerHTML=data.weather[0].main;
    }

  weatherfind('biratnagar');
  let input = document.getElementById("button");
  input.addEventListener("click", () => {
   let city = document.getElementById('searchBox').value;
   weatherfind(city);
  });