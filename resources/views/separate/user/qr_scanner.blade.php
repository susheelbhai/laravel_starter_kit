<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/dynamsoft-javascript-barcode@9.0.0/dist/dbr.js"></script>

  <script>
  Dynamsoft.DBR.BarcodeReader.license = "DLS2eyJoYW5kc2hha2VDb2RlIjoiMjAwMDAxLTE2NDk4Mjk3OTI2MzUiLCJvcmdhbml6YXRpb25JRCI6IjIwMDAwMSIsInNlc3Npb25QYXNzd29yZCI6IndTcGR6Vm05WDJrcEQ5YUoifQ==";
  </script>
</head>
<body>
    <div id="status">Initializing...</div>
    Choose image(s) to decode:
    <input id="ipt-file" type="file" multiple accept="image/png,image/jpeg,image/bmp,image/gif" disabled>
    <br><br>
    <button id="btn-show-scanner" disabled>show scanner</button>
<script>
  
  // reader for decoding picture
let reader = null;
// scanner for decoding video
let scanner = null;
window.onload = async function() {
    reader = await Dynamsoft.DBR.BarcodeReader.createInstance();
    if (reader) {
        document.getElementById('ipt-file').disabled = "";
    }
    scanner = await Dynamsoft.DBR.BarcodeScanner.createInstance();
    if (scanner) {
        document.getElementById('btn-show-scanner').disabled = "";
    }
    
    if (reader!= null || scanner!=null) {
        document.getElementById('status').remove();
    }
}
</script>

</body>
</html>
