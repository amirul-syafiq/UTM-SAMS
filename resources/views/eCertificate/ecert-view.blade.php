<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
       E-Certificate
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>

<body>

    <div class="container">
        <div id="divID">
            <div>
                <img id="svgImage" src="{{ $dataUri }}" />
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const { jsPDF } = window.jspdf;
            let doc = new jsPDF('p', 'mm', 'a4');
            let svgImage = document.querySelector('#svgImage');

            html2canvas(svgImage, { scale: 1 }).then(function(canvas) {
                let imgData = canvas.toDataURL('image/jpeg', 1.0);
                let imgWidth = doc.internal.pageSize.getWidth();
                let imgHeight = (canvas.height * imgWidth) / canvas.width;
                doc.addImage(imgData, 'JPEG', 0, 0, imgWidth, imgHeight);
                doc.save("newpdf.pdf");

            });
        });
    </script>
</body>

</html>
