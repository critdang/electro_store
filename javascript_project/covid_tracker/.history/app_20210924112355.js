getCovidWorld();
getCovidCountry();
function getCovidCountry(){
    fetch('https://coronavirus-tracker-api.herokuapp.com/v2/locations/274')
        .then(res => res.json())//trả về API kiểu json
        .then(data => {
            console.log(data)
            let id = data.location.id;
            let code = data.location.country_code;
            let quocgia = data.location.country;
            let danso = data.location.country_population;
            let capnhat = data.location.last_updated;
            let canhiem = data.location.latest.confirmed;
            let hoiphuc = data.location.latest.recovered;
            let tuvong = data.location.latest.deaths;


            document.getElementById('id').innerHTML = id;
            document.getElementById('quocgia').innerHTML = quocgia.toLocaleString("en");// hiện thị kiểu tiếng anh
            document.getElementById('code').innerHTML = code.toLocaleString("en");
            document.getElementById('danso').innerHTML = danso.toLocaleString("en");
            document.getElementById('capnhat').innerHTML = capnhat.substring(0,10);
            document.getElementById('canhiem').innerHTML = canhiem.toLocaleString("en");
            document.getElementById('tuvong').innerHTML = tuvong.toLocaleString("en");
            document.getElementById('hoiphuc').innerHTML = hoiphuc.toLocaleString("en");
            document.getElementById('phantram').innerHTML = ((Number(tuvong)/Number(canhiem))*100).toLocaleString("en",{minimumFractionDigits:2,maximumFractionDigits:2})+"%";

        });//data
}
function getCovidWorld(){
    fetch('https://coronavirus-tracker-api.herokuapp.com/v2/locations')
    .then(res => res.json())//trả về API kiểu json
    .then(data => {
        console.log(data)
        const html = data.locations.map(covid => {
            // tất cả dữ liệu bỏ vào biến covid
            const id = data.location.id;
            const code = data.location.country_code;
            const quocgia = data.location.country;
            const danso = data.location.country_population;
            const capnhat = data.location.last_updated;
            const canhiem = data.location.latest.confirmed;
            const hoiphuc = data.location.latest.recovered;
            const tuvong = data.location.latest.deaths;


        // document.getElementById('id').innerHTML = id;
        // document.getElementById('quocgia').innerHTML = quocgia.toLocaleString("en");// hiện thị kiểu tiếng anh
        // document.getElementById('code').innerHTML = code.toLocaleString("en");
        // document.getElementById('danso').innerHTML = danso.toLocaleString("en");
        // document.getElementById('capnhat').innerHTML = capnhat.substring(0,10);
        // document.getElementById('canhiem').innerHTML = canhiem.toLocaleString("en");
        // document.getElementById('tuvong').innerHTML = tuvong.toLocaleString("en");
        // document.getElementById('hoiphuc').innerHTML = hoiphuc.toLocaleString("en");
        // document.getElementById('phantram').innerHTML = ((Number(tuvong)/Number(canhiem))*100).toLocaleString("en",{minimumFractionDigits:2,maximumFractionDigits:2})+"%";
            return `
            <ul class="list_world">
                <li>
                    <p> id:0</p>
                    <p> Quốc giá:0</p>
                    <p> Dân số:0</p>
                    <p> Cập nhật:0</p>
                    <p> Ca nhiễm:0</p>
                    <p> Tử vong:0</p>
                    <p> Phần trăm:0</p>
                </li>
              </ul>
            `           
    }).join("");
    document.getElementById("list").insertAdjacentHTML("afterbegin",html);
    });
}
