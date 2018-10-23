<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PDF JS</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.550/pdf.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


    <style media="screen">
      #pdf-wrapper {
        width: 100%;
        height: auto;
        display: block;
      }
      canvas {
        margin: 0 auto;
        width: 800px !important;
        height: auto;
        display: block;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div id="pdf-wrapper">

        </div>
      </div>
    </div>
    <p>Test</p>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      var url = "Auto_CAD_Design_Suite.pdf";

      pdfjsLib.disableWorker = true;
      pdfjsLib.getDocument(url).then(function getPdfHelloWorld(pdf) {
          // Get the number of pages
          var num = pdf.numPages;

          // Loop through all pages and draw.
          for (let i = 0; i < num; i += 1) {
            pdf.getPage(i).then((page) => {
              const canvas = document.createElement('canvas');
              canvas.id = i;
              // document.getElementById('pdf-wrapper').appendChild(canvas);
              $("pdf-wrapper").append(canvas);
              pdf.getPage(i).then((page) => {
                renderPage(page, canvas);
                }
              );
            });
          }
      });

      function renderPage(page, canvas) {
        const viewport = page.getViewport(1);
        const canvasContext = canvas.getContext('2d');
        const renderContext = {
          canvasContext,
          viewport
        };
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        page.render(renderContext);
      }
    </script>
  </body>
</html>
