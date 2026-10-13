 <script>
    // Listen for messages from the iframe
    window.addEventListener("message", function(event) {
      // Optionally check origin for security
      console.log("Message from iframe:", event.data);

      // Example: log the table HTML
      if (event.data.type === "tableData") {
        console.log("Table HTML:", event.data.html);
      }
    });
  </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="httQps://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
<iframe id="ifctables" frameborder="0"  scrolling="no" width="400" height="700" src="https://www.fctables.com/indonesia/super-liga/iframe/?type=table&lang_id=2&country=102&template=318&team=&timezone=Pacific/Midway&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=0&ga=0&gd=0&pts=1&ng=0&form=0&width=300&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&tlink=0&scfs=22&scfc=333333&scb=1&sclg=1&ths=0&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=3bafda&hfc=FFFFFF"></iframe><div style="text-align:center;"></div><a href="https://www.fctables.com/indonesia/super-liga/" rel="nofollow">FcTables.com</a>

<script>

document.getElementById("ifctables").addEventListener("load", function() {
    const iframe = this;
    const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

    const table = iframeDoc.querySelector("table");
    if (table) {
        table.querySelectorAll("tr").forEach((row, i) => {
            let rowData = [];
            row.querySelectorAll("th, td").forEach(cell => {
                rowData.push(cell.innerText.trim());
            });
            console.log("Row " + i + ":", rowData);
        });
    } else {
        console.warn("No table found inside iframe document.");
    }
});

var bodytable = $("#ifctables").contents().find("body").html()
console.log(bodytable)
// iframe.contentDocument.querySelector("table")

    // Access iframe document
const iframe = document.getElementById("ifctables");
const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

// Example: Get all input values
let values = {};
iframeDoc.querySelectorAll("table").forEach(el => {
    values[el.name] = el.value;
});


console.log(values);
axios.post("http://localhost:1933/api/post_klasmen", values, {
    headers: {
        "Authorization": "Bearer B3is2mill6AH6Alhamdulillah",
        "Content-Type": "application/json"
    }
})
.then(res => {
    console.log(res.data);
    console.log("Saved:", values);
})
.catch(err => {
    console.error("Error:", err);
});



</script>