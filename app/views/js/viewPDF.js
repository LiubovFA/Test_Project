let currentPDF;
let currentPage;
let maxPage;
let pdfLib;
let loadingTask;

//выполняется при загрузке страницы - настройка окна, получение данных документа
function init(pdfData)
{
    console.log("init is starting");
    currentPDF = atob(pdfData);

    pdfLib = window['pdfjs-dist/build/pdf'];
    // The workerSrc property shall be specified.
    pdfLib.GlobalWorkerOptions.workerSrc = '//cdn.jsdelivr.net/npm/pdfjs-dist@2.5.207/build/pdf.worker.min.js';

    currentPage = 1;

    loadingTask = pdfLib.getDocument({data: currentPDF});
    loadingTask.promise.then(
        function (pdf)
        {
            maxPage = pdf.numPages;
            document.getElementById("maxPages").innerText = maxPage;
            document.getElementById("pageNum").max = maxPage;
        },
        function (reason) {
            // PDF loading error
            console.error(reason);
        }
    )

    console.log("init is finished");
}

//отображение страницы
function render(num)
{
    console.log(typeof num);
    console.log("rendering is starting");
    //var loadingTask = pdfLib.getDocument({data: currentPDF});

    loadingTask.promise.then(
        function (pdf)
        {
            console.log(num);
            var pageNum = parseInt(num, 10);
            console.log(pdf.numPages + pageNum);
            if (pageNum <= pdf.numPages && pageNum > 0)
            {
                pdf.getPage(pageNum).then(
                    function (page) {
                        console.log("loading page");
                        var scale = 1.25;
                        var viewport = page.getViewport( { scale: scale } );

                        // Prepare canvas using PDF page dimensions
                        var canvas = document.getElementById('my canvas');
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        // Render PDF page into canvas context
                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };

                        var renderTask = page.render(renderContext);
                        renderTask.promise.then(
                            function () {
                                console.log('Page rendered');
                            });
                        console.log("page is loaded");
                    }
                );
                console.log('rendering is finished');
            }
        },function (reason) {
            // PDF loading error
            console.error(reason);
        }
    )
}

//переход на следующую страницу
function nextPage()
{
    var nextPage = currentPage+1;
    if (nextPage >0 && nextPage <= maxPage) {
        currentPage = nextPage;
        render(currentPage);
        document.getElementById("pageNum").value = currentPage;
    }
}

//переход на предыдущую страницу
function prevPage()
{
    var prevPage = currentPage-1;
    if (prevPage > 0 && prevPage <= maxPage) {
        currentPage = prevPage;
        render(currentPage);
        document.getElementById("pageNum").value = currentPage;
    }
}

//отображение введеной страницы при нажатии Enter
document.getElementById("pageNum").onkeydown = function (event)
{
    var e = event.code;
    /*
     if (event.key !== undefined) {
         e = event.key;
     }
     else if (event.keyIdentifier !== undefined) {
         e = event.keyIdentifier;
     }
     else if (event.keyCode !== undefined) {
         e = event.keyCode;
     }*/

    console.log(e);

    if (e === "Enter") {
        let showPage = parseInt(document.getElementById("pageNum").value);

        if (showPage <= 0 || showPage > maxPage)
            document.getElementById("pageNum").value = currentPage;
        else if (showPage !== currentPage)
        {
            currentPage = showPage;
            render(currentPage);
        }
    }
}
