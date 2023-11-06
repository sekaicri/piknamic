<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Mockups dinámicos para Branding | Piknamic</title>
    <link rel="shortcut icon" href="TemplateData/favicon.ico">
    <link rel="stylesheet" href="TemplateData/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
  </head>
  <body>
  <div id="unity-container" style="width: 100%; height: 100%">
  <canvas id="unity-canvas" width=auto height=auto></canvas>
      <div id="unity-loading-bar">
        <div id="unity-logo"></div>
        <div id="unity-progress-bar-empty">
          <div id="unity-progress-bar-full"></div>
        </div>
      </div>
      <div id="unity-warning"> </div>
    </div>
    <script>
      var container = document.querySelector("#unity-container");

      var gameInstance = null;
      var canvas = document.querySelector("#unity-canvas");
      var loadingBar = document.querySelector("#unity-loading-bar");
      var progressBarFull = document.querySelector("#unity-progress-bar-full");
      var fullscreenButton = document.querySelector("#unity-fullscreen-button");
      var warningBanner = document.querySelector("#unity-warning");

      // Shows a temporary message banner/ribbon for a few seconds, or
      // a permanent error message on top of the canvas if type=='error'.
      // If type=='warning', a yellow highlight color is used.
      // Modify or remove this function to customize the visually presented
      // way that non-critical warnings and error messages are presented to the
      // user.
      function unityShowBanner(msg, type) {
        function updateBannerVisibility() {
          warningBanner.style.display = warningBanner.children.length ? 'block' : 'none';
        }
        var div = document.createElement('div');
        div.innerHTML = msg;
        warningBanner.appendChild(div);
        if (type == 'error') div.style = 'background: red; padding: 10px;';
        else {
          if (type == 'warning') div.style = 'background: yellow; padding: 10px;';
          setTimeout(function() {
            warningBanner.removeChild(div);
            updateBannerVisibility();
          }, 5000);
        }
        updateBannerVisibility();
      }

      var buildUrl = "Build";
      var loaderUrl = buildUrl + "/Piknamic.loader.js";
      var config = {
        dataUrl: buildUrl + "/Piknamic.data",
        frameworkUrl: buildUrl + "/Piknamic.framework.js",
        codeUrl: buildUrl + "/Piknamic.wasm",
        streamingAssetsUrl: "StreamingAssets",
        companyName: "DefaultCompany",
        productName: "Picnamick",
        productVersion: "0.1",
        showBanner: unityShowBanner,
      };

      // By default Unity keeps WebGL canvas render target size matched with
      // the DOM size of the canvas element (scaled by window.devicePixelRatio)
      // Set this to false if you want to decouple this synchronization from
      // happening inside the engine, and you would instead like to size up
      // the canvas DOM size and WebGL render target sizes yourself.
      // config.matchWebGLToCanvasSize = false;

      if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
        // Mobile device style: fill the whole browser client area with the game canvas:

        var meta = document.createElement('meta');
        meta.name = 'viewport';
        meta.content = 'width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, shrink-to-fit=yes';
        document.getElementsByTagName('head')[0].appendChild(meta);
        container.className = "unity-mobile";
        canvas.className = "unity-mobile";

        // To lower canvas resolution on mobile devices to gain some
        // performance, uncomment the following line:
        // config.devicePixelRatio = 1;

        unityShowBanner('WebGL builds are not supported on mobile devices.');
      } else {
        // Desktop style: Render the game canvas in a window that can be maximized to fullscreen:

        canvas.style.width = "100%";
        canvas.style.height = "100%";
      }

      loadingBar.style.display = "block";

      var script = document.createElement("script");
      script.src = loaderUrl;
      script.onload = () => {
        createUnityInstance(canvas, config, (progress) => {
          progressBarFull.style.width = 100 * progress + "%";
        }).then((unityInstance) => {

          gameInstance = unityInstance;
          loadingBar.style.display = "none";         
        }).catch((message) => {
          alert(message);
        });
      };
      document.body.appendChild(script);

    document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);

    const userDataCifrado = urlParams.get('userData');
    const projectsCifrado = urlParams.get('projects');
    
    // Clave secreta para descifrar
    const claveSecreta = 'P1kn4m1c*2023';
    // Descifrar los datos utilizando AES y la clave secreta
    const bytesUserDataCifrado = CryptoJS.enc.Base64.parse(userDataCifrado);
    const bytesProjectsCifrado = CryptoJS.enc.Base64.parse(projectsCifrado);
    const bytesUserDataDescifrado = CryptoJS.AES.decrypt({ ciphertext: bytesUserDataCifrado }, claveSecreta);
    const bytesProjectsDescifrado = CryptoJS.AES.decrypt({ ciphertext: bytesProjectsCifrado }, claveSecreta);
    const jsonStringUserData = bytesUserDataDescifrado.toString(CryptoJS.enc.Utf8);
    const jsonStringProjects = bytesProjectsDescifrado.toString(CryptoJS.enc.Utf8); 
    // Convertir las cadenas JSON descifradas de vuelta a objetos
    const userData = JSON.parse(jsonStringUserData);
    const projects = JSON.parse(jsonStringProjects);
    console.log('Datos de usuario descifrados:', userData);
    console.log('Datos de proyectos descifrados:', projects);
     });
 
    </script>
  
    <!-- BEGIN WEBGL FILE BROWSER LIB -->
    <style>
        #fb_popup_background.highlight {
            border: 3px dashed #ccc;
            border-radius: 26px;
            border-color: aquamarine;
        }
    </style>

    <div id="fileBrowserPopup" style="display: none; margin: -0.4%; position: absolute; width: 100%; height: 100%; left: 0; top: 0; bottom: 0; right: 0;">
        <img src="FileBrowser/2x2.png" style="position: absolute; width: 100%; height: 100%;" />

        <div id="fb_popup">
            <img id="fb_popup_background" src="FileBrowser/popup_background.png" style="position: fixed; top: 0;  right: 0; bottom: 0; left: 0; margin: auto; width: 502.5px; height: 206px;" />
            <div>
                <img src="FileBrowser/popup_header.png" style="position: fixed; top: -146px;  right: 0; bottom: 0; left: 0; margin: auto; width: 502.5px; height: 60.5px;" />
                <strong id="fb_popup_header_title" style="position: fixed; top: -110px;  right: -20px; bottom: 0; left: 0; margin: auto; width: 500px; height: 58px; color: white;">
                    File Browser
                </strong>
            </div>
            <div id="open_file_form">
                <strong id="fb_popup_description_title" style="position: fixed; top: 0px;  right: 0px; bottom: 0; left: 0; margin: auto; width: 500px; height: 58px; text-align: center; color: black;">
                    Select file to load or use drag & drop
                </strong>

                <label for="fileToUpload">
                    <img src="FileBrowser/select_button.png" style="position: fixed; top: 0px;  right: 250px; bottom: -80px; left: 0; margin: auto; width: 193.5px; height: 41px;" />
                    <strong id="fb_popup_select_button_title" style="position: fixed; top: 0px;  right: 250px; bottom: -100px; left: 0; margin: auto; width: 193.5px; height: 41px; text-align: center; color: white;">
                        Select
                    </strong>
                </label>
                <input type="file" multiple name="fileToUpload" id="fileToUpload" style="width: 0px; height: 0px;" onchange="fbLoadFiles(event.target.files);return false;" />
        
                <label for="closePopup">
                    <img src="FileBrowser/close_button.png" style="position: fixed; top: 0px;  right: -250px; bottom: -80px; left: 0; margin: auto; width: 193.5px; height: 41px;" />
                    <strong id="fb_popup_close_button_title" style="position: fixed; top: 0px;  right: -245px; bottom: -100px; left: 0; margin: auto; width: 193.5px; height: 41px; text-align: center; color: white;">
                        Close
                    </strong>
                </label>
                <input type="button" name="closePopup" id="closePopup" style="width: 0px; height: 0px;" onclick="requestCloseFileBrowserForOpen()" />
            </div>
        </div>
    </div>

    <script type='text/javascript'>
        // ************************ Drag and drop ***************** //
        let dropArea = document.getElementById("fb_popup");
        let dropAreaBG = document.getElementById("fb_popup_background");

        // Prevent default drag behaviors
        ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        })

        // Highlight drop area when item is dragged over it
        ;['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        })

        ;['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        })

        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false);

        function preventDefaults (e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            dropAreaBG.classList.add('highlight');
        }

        function unhighlight(e) {
            dropAreaBG.classList.remove('highlight');
        }

        function handleDrop(e) {
            var dt = e.dataTransfer;
            var files = dt.files;

            fbLoadFiles(files)
        }
    </script>

    <script type='text/javascript'>
        function callFBFunctionByName(functionName, parameter){
            switch(functionName){
                case "initializeFBLibrary":
                    initializeFBLibrary();
                    break;
                case "openFileBrowserForLoad":
                    openFileBrowserForLoad(parameter);
                    break;
                case "cleanupFB":
                    cleanupFB();
                    break;       
                case "closeFileBrowserForOpen":
                    closeFileBrowserForOpen();
                    break;
                case "saveFile":
                    saveFileFB(parameter);
                    break;
                case "setLocalization":
                    setLocalizationFB(parameter);
                    break;
            }
        }
        document.callFBFunctionByName = callFBFunctionByName;

        function initializeFBLibrary(){
            document.fbPopup = document.getElementById("fileBrowserPopup");
            document.fbOpenFilePopupInput = document.getElementById("fileToUpload");

            document.fbStorage = { 
                initialized: true,
                loadedFiles: {},
                dataPointers: []
            };
        }

        function openFileBrowserForLoad(parameters){
            if(document.fbStorage.initialized !== true)
                return;

            var typesFilter = parameters[0];
            var isMultipleSelection = parameters[1] === 1 ? true : false;

            if(document.fbOpenFilePopupInput.hasAttribute('multiple'))
                document.fbOpenFilePopupInput.removeAttribute('multiple');

            if(isMultipleSelection){
                document.fbOpenFilePopupInput.setAttribute('multiple', '');
            }

            document.fbOpenFilePopupInput.accept = typesFilter;
		    document.fbPopup.style.display = "flex";
        }

        function closeFileBrowserForOpen(){
            if(document.fbStorage.initialized !== true)
                return;
            document.fbPopup.style.display = "none";
        }

        function cleanupFB() {
            if(document.fbStorage.initialized !== true)
                return;
            document.fbStorage.loadedFiles = {};
            document.fbStorage.dataPointers = [];
        }

        function saveFileFB(fileData){
            if(document.fbStorage.initialized !== true)
                return;

            let fileInfo = {
                status: true,
                message: "",
                name: fileData.name
            };

            try{
                var contentType = 'application/octet-stream';
                var a = document.createElement('a');
                var blob = new Blob([fbBase64ToBytesArray(fileData.data)], {
                    'type': contentType
                });
                a.href = window.URL.createObjectURL(blob);
                a.download = fileData.name;

                if (document.createEvent) {
                    var event = document.createEvent('MouseEvents');
                    event.initEvent('click', true, true);
                    a.dispatchEvent(event);
                } else {
                    a.click();
                }

                gameInstance.SendMessage(libraryHandlerObjectName, "HandleFileSaved", JSON.stringify(fileInfo));
            }
            catch(ex){
                fileInfo.status = false;
                fileInfo.message = ex.message;

                gameInstance.SendMessage(libraryHandlerObjectName, "HandleFileSaved", JSON.stringify(fileInfo));
            }
        }

        const libraryHandlerObjectName = "[FGFileBrowser]";

        function fbLoadFiles(files) {
            gameInstance.SendMessage(libraryHandlerObjectName, 'SetAmountOfFilesToBeLoaded', files.length);

            for (var i = 0, f; f = files[i]; i++) {
                var reader = new FileReader();
                reader.onload = (function (file) {
                    return function (fileloadEvent) {
                        let loadedFileInfo = fileloadEvent.target.result;
                
                        document.fbStorage.loadedFiles[file.name] = {
                            info: loadedFileInfo
                        };

                        let extensionSplit = file.name.split('.');
                        let extension = extensionSplit[extensionSplit.length - 1];
                        let name = file.name.replace(extension, "");
                        name = name.substring(0, name.length - 1);

                        let loadedFile = {
                            fullName: file.name,
                            name: name,
                            path: "unavailable-in-web",
                            length: loadedFileInfo.byteLength,
                            size: file.size,
                            extension: extension
                        };

                        gameInstance.SendMessage(libraryHandlerObjectName, 'HandleLoadedFile', JSON.stringify(loadedFile));
                    }
                })(f);
                
                reader.readAsArrayBuffer(f);
            }
			document.fbOpenFilePopupInput.value = "";
        }

        function requestCloseFileBrowserForOpen() {
            gameInstance.SendMessage(libraryHandlerObjectName, "CloseFileBrowserForOpen");
        }

        function fbBase64ToBytesArray(base64) {
            var binary_string = window.atob(base64);
            var len = binary_string.length;
            var bytes = new Uint8Array(len);
            for (var i = 0; i < len; i++) {
                bytes[i] = binary_string.charCodeAt(i);
            }
            return bytes.buffer;
        }

        function setLocalizationFB(parameter){
            switch(parameter.key){
                case "HEADER_TITLE":
                    document.getElementById("fb_popup_header_title").innerHTML = parameter.value;
                    break;
                case "DESCRIPTION_TEXT":
                    document.getElementById("fb_popup_description_title").innerHTML = parameter.value;
                    break;
                case "SELECT_BUTTON_CONTENT":
                    document.getElementById("fb_popup_select_button_title").innerHTML = parameter.value;
                    break;
                case "CLOSE_BUTTON_CONTENT":
                    document.getElementById("fb_popup_close_button_title").innerHTML = parameter.value;
                    break;
            }
        }

    </script>
    <!-- END WEBGL FILE BROWSER LIB -->
</body>
</html>
