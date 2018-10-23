

function closeModalPopup() {
    $('#ModalPopup').hide();
}

var finalclickedAttr2;
var isLinkShown = false;

$('.demo2').click(function () {
    isLinkShown = false;
    var clickedAttr2 = $(this).attr("value");
    finalclickedAttr2 = clickedAttr2.toLowerCase();
    console.log(finalclickedAttr2);
    $('#output2').text($(this).attr("name"));
    $('#output4').text($(this).attr("name"));


    $('#formSelection').show(); //show hidden field set
    $('#desktopDownload').hide();
    $('#ModalPopupVideo').hide();

    newVideo.hide();
    newPdf.hide();

    hideDemostartionVideo();

    //show modal after click
    $('#ModalPopup').show();
});


function processIntent2(ModalPopup) {
    $('#formSelection').show(); //show hidden field set
    var resourceType2 = $("input:checkbox[name=action2]:checked").val();

    if (isLinkShown) {
        //close modal onn ok click if we have already displayed the go to linkik message
        console.log("hapa");
        $('#formSelection').hide(); //show hidden field set
        $('#desktopDownload').show();
        $('#ModalPopup').show();
    }

    console.log(resourceType2);
    if (resourceType2 === undefined) {
        console.log("this is undefined");
    } else if (resourceType2 === "procedure2") {
      console.log("attr: " + finalclickedAttr2);
        newPdf.show();
        closeIntent2(ModalPopup);
        var pdfFile = "https://www.demoscad.net/statusbar/resources/" + finalclickedAttr2 + "/overview.pdf";
        console.log(pdfFile);
        pdfjsLib.disableWorker = true;
        pdfjsLib.getDocument(pdfFile).then(function getPdfHelloWorld(pdf) {
          // Get the number of pages
          var num = pdf.numPages;

          // Loop through all pages and draw.
          for (let i = 0; i < num; i+= 1) {
            pdf.getPage(i).then((page) => {
              const canvas = document.createElement('canvas');
              canvas.id = i;
              document.getElementById('pdf-wrapper').appendChild(canvas);
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

        // newPdf.attr('src', pdfFile);

        modalViewerShow();
        deductPDF();

    } else if (resourceType2 === "tutorial2") {
        closeIntent2(ModalPopup);
        var videoFile = "https://www.demoscad.net/statusbar/resources/" + finalclickedAttr2 + "/vid1.mp4";
        newVideo.attr('src', videoFile);
        var video = newVideo.get(0);
        newVideo.show();
        modalViewerShow();
        decuctTutorial()
    }
}

function closeIntent2(ModalPopup) {
    $('#' + ModalPopup).hide();// close the modal
}

function hideDemostartionVideo() {
    $('#maithoVideo').hide();
    $("#videoPlayer").get(0).pause();
}

// NEW MODAL
// Get the modal
var modalViewer = document.getElementById('modalViewer');
// Get the <span> element that closes the modal
var span = document.getElementById("newClose2");
// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modalViewer.style.display = "none";
    modalViewerHide();
};
// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target === modalViewer) {
        modalViewer.style.display = "none";
        newVideo.pause();
        newVideo.hide();
        newPdf.hide();
    }
};

function modalViewerShow() {
    modalViewer.style.display = "block";
}

function modalViewerHide() {
    newPdf.hide();
    modalViewer.style.display = "none";
    newVideo.pause();
    newVideo.hide();

}

var newVideo = $(".newModalContent video");
var newPdf = $("#canvas-pdf");

function closeModalVideo() {
    $('#modalVid').get(0).load();
    $('video').trigger('pause');
    $('#ModalPopup').show();
    $('.newModalContent video').hide();
    $('.newModalContent iframe').hide();
}



dragModalElement(document.getElementById(("ModalPopup")));

function dragModalElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    document.getElementById(elmnt.id + "header").onmousedown = modalMouseDown;
  } else {
    elmnt.onmousedown = modalMouseDown;
  }

  function modalMouseDown(e) {
    e = e || window.event;
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeModalElement;
    document.onmousemove = elementModalDrag;
  }

  function elementModalDrag(e) {
    e = e || window.event;
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeModalElement() {
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

dragPopupElement(document.querySelectorAll("#modalViewer, #openVideo, #openAppVideo, #openArchVideo"));

function dragPopupElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    document.getElementById(elmnt.id + "header").onmousedown = PopupMouseDown;
  } else {
    elmnt.onmousedown = PopupMouseDown;
  }

  function PopupMouseDown(e) {
    e = e || window.event;
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closePopupElement;
    document.onmousemove = elementPopupDrag;
  }

  function elementPopupDrag(e) {
    e = e || window.event;
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closePopupElement() {
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
