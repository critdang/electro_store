getCovidWorld();
getCovidCountry();
function getCovidWorld(){
    fetch('https://coronavirus-tracker-api.herokuapp.com/v2/locations/266')
        .then(res => res.json())//trả về API kiểu json
        .then(data => {
            let id = data.location.country;
            document.getElementById('quocgia')
        });//data
}
function getCovidCountry(){

}
