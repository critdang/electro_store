getCovidWorld();
getCovidCountry();
function getCovidWorld(){
    fetch('https://github.com/ExpDev07/coronavirus-tracker-api')
        .then(res => res.json())//trả về API kiểu json
        .then(data => console.log(data))//data
}
function getCovidCountry(){

}
