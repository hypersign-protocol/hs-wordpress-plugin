
console.log("Hypersign loaded")


class MyClass extends EventTarget {

    updateQRCodeUI() {
      this.dispatchEvent(new Event('something'));
    }
  }
  

function updateQRCodeListener(e){
    const json = e.currentTarget.json 
    console.log(e.currentTarget);
    $("#qrcode").qrcode({ "width": 300, "height": 300, "text": JSON.stringify(json) });
    console.log('Instance fired "something".', e);
}
  const instance = new MyClass();
  
  instance.addEventListener('something', updateQRCodeListener, false);
  