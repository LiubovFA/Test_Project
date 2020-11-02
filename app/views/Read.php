<br>
<br>

<div id="app">
    <div id="toolbar">
        <div id="pager-div">
            <label id="pages">Страница <input name="pageNum" id="pageNum" type="number" value="1" min="1"> / <label id="maxPages"></label></label>
            <button data-pager="prev" onclick="prevPage()"><<<</button> <button data-pager="next" onclick="nextPage()">>>></button>
        </div>
        <label id="currentBook">
            <?php
            echo "<q>".$data[0]['Name']."</q> - ". $data[0]['Full_name'];

            $last_key = array_key_last($data);

            if ($last_key > 0)
            {
                foreach ($data as $row)
                    echo ', '.$row['Full_name'];
            }
            ?>
            <label>
    </div>
    <div id="viewport" role="main">
        <canvas id="my canvas"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.5.207/build/pdf.min.js"></script>

<script src="/app/views/js/viewPDF.js"></script>

<script type="text/javascript">
    //подготовка данных и отображение первой страницы
    window.onload = function () {
        init("<?php echo base64_encode($data[0]['Content'])?>");
        render(1);
        // rendering("<!?php echo base64_encode($data[0]['Content'])?>");
    }
</script>
<!object data="data:application/pdf;base64,<!?php echo base64_encode($data[0]['Content'])?>" type="application/pdf" style="min-height:100vh;width:100%"">Документ для чтения:<!/object>
