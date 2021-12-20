getCovidWorld();
getCovidCountry();
function getCovidWorld(){
    fetch('https://coronavirus-tracker-api.herokuapp.com/v2/locations/274')
        .then(res => res.json())//trả về API kiểu json
        .then(data => {
            let id = data.location.id;
            let quocgia = data.location.country;
            document.getElementById('quocgia').innerHTML = quocgia.toLocaleString("en");// hiện thị kiểu tiếng anh
        });//data
}
function getCovidCountry(){

}
