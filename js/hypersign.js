
console.log("Hypersign loaded")



class MyClass extends EventTarget {

    updateQRCodeUI() {
      this.dispatchEvent(new Event('something'));
    }
  }
  

function updateQRCodeListener(e){
    const json = e.currentTarget.json 
    $("#qrcode").qrcode({ "width": 300, "height": 300, "text": JSON.stringify(json) });
}
  const instance = new MyClass();
  
  instance.addEventListener('something', updateQRCodeListener, false);
  