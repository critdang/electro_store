getCovidWorld();
getCovidCountry();
function getCovidWorld(){
    fetch('https://coronavirus-tracker-api.herokuapp.com/v2/locations')
        .then(res => res.json())//trả về API kiểu json
        .then(data => console.log(data))//data
}
function getCovidCountry(){

}
