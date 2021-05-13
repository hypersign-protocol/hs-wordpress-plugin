// fetch("http://192.168.43.43/index.php/wp-json/hypersign/v1/challenge").then(resp => resp.json()).then(json => {
//     console.log(json);
//     $("#qrcode").qrcode({ "width": 300, "height": 300, "text": JSON.stringify(json) });
// })
console.log("Hypersign loaded")

async function fetchChallenge(){
    const resp = await fetch("http://192.168.43.43/index.php/wp-json/hypersign/v1/challenge");
    const json = await resp.json();
    return json;
}




async function  updateQR(){

    
        const json = await fetchChallenge();
        console.log(json);
        const challenge = json.message;
        setCookie("challenge", challenge);
        $("#qrcode").qrcode({ "width": 300, "height": 300, "text": JSON.stringify(json) });
    
}
updateQR();