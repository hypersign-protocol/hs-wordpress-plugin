
console.log("Hypersign loaded")

async function fetchChallenge() {
    const resp = await fetch("http://192.168.43.43/index.php/wp-json/hypersign/api/v1/challenge");
    const json = await resp.json();
    return json;
}

async function updateQR() {
    const json = await fetchChallenge();
    console.log(json);
    const challenge = json.challenge;
    console.log(challenge);
    setCookie("challenge", challenge);
    $("#qrcode").qrcode({ "width": 300, "height": 300, "text": JSON.stringify(json) });

}
updateQR();