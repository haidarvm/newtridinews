<div id="my-table"></div>
<script src="httQps://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 

<script>

// Access iframe content (same origin only)
var iframeDoc = $('#fctables').contents();

// Extract table data
var tableData = [];
iframeDoc.find('table tr').each(function() {
    var row = [];
    $(this).find('td, th').each(function() {
        row.push($(this).text().trim());
    });
    if (row.length > 0) {
        tableData.push(row);
    }
});

console.log(tableData);
</script>
<iframe frameborder="0" id="fctables"  scrolling="no" width="520" height="700" src="https://www.fctables.com/indonesia/super-liga/iframe/?type=table&lang_id=2&country=102&template=318&team=191739&timezone=Asia/Jakarta&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=0&ga=0&gd=0&pts=1&ng=0&form=0&width=350&height=700&font=Helvetica&fs=16&lh=30&bg=FFFFFF&fc=333333&logo=0&tlink=0&scfs=26&scfc=333333&scb=1&sclg=1&teamls=80&ths=0&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=0&hfb=1&hbc=3bafda&hfc=FFFFFF"></iframe><div style="text-align:center;"></div><a href="https://www.fctables.com/indonesia/super-liga/" rel="nofollow">FcTables.com</a>

<?php
// $ch = curl_init("https://www.fctables.com/indonesia/super-liga/iframe/?type=table&lang_id=2&country=102&template=318&team=&timezone=Pacific/Midway&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=1&form=1&width=520&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&tlink=1&scfs=22&scfc=333333&scb=1&sclg=1&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=3bafda&hfc=FFFFFF");
// curl_setopt_array($ch, [
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_FOLLOWLOCATION => true,
//     CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/127 Safari/537.36",
//     CURLOPT_HTTPHEADER => [
//         "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
//         "Accept-Language: en-US,en;q=0.5",
//     ]
// ]);
// $html = curl_exec($ch);
// curl_close($ch);

// echo $html;
?>