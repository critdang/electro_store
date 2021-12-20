getCovidWorld();
getCovidCountry();
function getCovidWorld(){
    fetch('https://coronavirus-tracker-api.herokuapp.com/v2/locations/274')
        .then(res => res.json())//trả về API kiểu json
        .then(data => {
            console.log(data)
            let id = data.location.id;
            let code = data.location.country_code;
            let quocgia = data.location.country;
            let danso = data.location.country_population;
            let capnhat = data.location.last_updated;
            let canhiem = data.location.lastest.confirmed;
            let tuvong = data.location.lastest.recovered;

            document.getElementById('id').innerHTML = id;
            document.getElementById('quocgia').innerHTML = quocgia.toLocaleString("en");// hiện thị kiểu tiếng anh
            document.getElementById('code').innerHTML = code.toLocaleString("en");
            document.getElementById('danso').innerHTML = danso.toLocaleString("en");
            document.getElementById('capnhat').innerHTML = quocgia.subString(0,10);
            document.getElementById('canhiem').innerHTML = canhiem.toLocaleString("en");
            document.getElementById('tuvong').innerHTML = tuvong.toLocaleString("en");
            document.getElementById('phantram').innerHTML = (Number(tuvong)/Number(canhiem)*100);

        });//data
}
function getCovidCountry(){
``
}
