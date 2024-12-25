<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Signature Pad</title>
    <style>
        canvas {
            border: 1px solid #000;
            display: block;
            margin: 20px auto;
        }

        button {
            display: block;
            margin: 10px auto;
        }

    </style>
</head>
<body>
    <h1 style="text-align: center;">Draw Your Signature</h1>
    <canvas id="signaturePad" width="600" height="300"></canvas>
    <button id="clearButton">Clear</button>
    <button id="saveButton">Save as PNG</button>
    <a href="{{ url('generate_pdf') }}">
        <button id="savePDF">Save as PDF</button>
    </a>

    <script>
        const canvas = document.getElementById('signaturePad');
        const ctx = canvas.getContext('2d');
        const clearButton = document.getElementById('clearButton');
        const saveButton = document.getElementById('saveButton');
        let drawing = false;

        // Set up canvas for drawing
        canvas.addEventListener('mousedown', (e) => {
            drawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        });

        canvas.addEventListener('mousemove', (e) => {
            if (drawing) {
                ctx.lineTo(e.offsetX, e.offsetY);
                ctx.stroke();
            }
        });

        canvas.addEventListener('mouseup', () => {
            drawing = false;
        });

        canvas.addEventListener('mouseout', () => {
            drawing = false;
        });

        // Clear the canvas
        clearButton.addEventListener('click', () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        });

        // Save the canvas content as PNG
        saveButton.addEventListener('click', () => {
            /*const link = document.createElement('a');
            link.download = 'signature.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
            */
            const dataURL = canvas.toDataURL('image/png');
            fetch('/save-signature', {
                    method: 'POST'
                    , headers: {
                        'Content-Type': 'application/json'
                        , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    , }
                    , body: JSON.stringify({
                        image: dataURL
                    })
                , })
                .then(response => response.json())
                .then(result => {
                    alert(result.message);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

    </script>
</body>
</html>
