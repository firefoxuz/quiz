const imageUpload = document.getElementById("imageUpload");
const event = new Event('build');
let des;
let des_json;
Promise.all([
    faceapi.nets.faceRecognitionNet.loadFromUri("/models"),
    faceapi.nets.faceLandmark68Net.loadFromUri("/models"),
    faceapi.nets.ssdMobilenetv1.loadFromUri("/models"),
]).then(start);

async function start() {
    des = null;
    des_json = null;
    const container = document.createElement("div");
    container.style.position = "relative";
    document.body.append(container);

    let image;
    let canvas;
    document.body.append("Loaded");
    imageUpload.addEventListener("change", async () => {
        image = await faceapi.bufferToImage(imageUpload.files[0]);
        canvas = faceapi.createCanvasFromMedia(image);
        const displaySize = {width: image.width, height: image.height};
        faceapi.matchDimensions(canvas, displaySize);
        const detections = await faceapi
            .detectSingleFace(image)
            .withFaceLandmarks()
            .withFaceDescriptor();
        des = detections.descriptor;
        des_json = JSON.stringify(des);
        console.log(des_json);

        document.dispatchEvent(event);

    });
}

