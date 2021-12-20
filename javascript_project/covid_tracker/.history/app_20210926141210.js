getCovidWorld();
getCovidCountry();
getSelectCountry();
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
            const id = covid.id;
            const code = covid.country_code;
            const quocgia = covid.country;
            const tinh = covid.province;
            const danso = covid.country_population;
            const capnhat = covid.last_updated;
            const canhiem = covid.latest.confirmed;
            const hoiphuc = covid.latest.recovered;
            const tuvong = covid.latest.deaths;


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
                <!--nối giữa biến java và dom-->
                    <p> id: ${id}</p>
                    <p style='color:red'> Quốc gia:${quocgia.toLocaleString("en")}</p>
                    <p style='color:blue'> Quốc gia:${tinh.toLocaleString("en")}</p>
                    <p> Mã Quốc gia:${code}</p>
                    <p> Dân số:${new Intl.NumberFormat().format(danso)}</p>
                    <p> Cập nhật:${capnhat.substring(0,10)}</p>
                    <p> Ca nhiễm:${new Intl.NumberFormat().format(canhiem)}</p>
                    <p> Tử vong:${new Intl.NumberFormat().format(tuvong)}</p>
                    <p> Phần trăm:${
                        ((Number(tuvong)/Number(canhiem))*100).toLocaleString("en",{minimumFractionDigits:2,maximumFractionDigits:2})+"%"}
                    </p>
                </li>
              </ul>
            `           
    }).join("");
    document.getElementById("list").insertAdjacentHTML("afterbegin",html);
    });
}
function getSelectCountry(){
    fetch('https://coronavirus-tracker-api.herokuapp.com/v2/locations')
    .then(res => res.json())//trả về API kiểu json
    .then(data => {
        console.log(data)
        const html = data.locations.map(list => {
            // tất cả dữ liệu bỏ vào biến covid
            const id = list.id;
            const quocgia = list.country;
            var option = document.createElement('option');
            option.value = id;
            // option.innerHTML = quocgia;
            if(list.province = ""){
                option.innerHTML = quocgia +'-'+list.province;
            }else{
                option.innerHTML = quocgia;
            }
            document.getElementById('select_world').appendChild(option);
            
    });

    });
}
