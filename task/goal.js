// goals.cjs
const fs = require("fs");
const puppeteer = require("puppeteer");

(async () => {
  const browser = await puppeteer.launch({ headless: true });
  const page = await browser.newPage();

  await page.goto(
    "https://www.goal.com/id/super-league/tabel/117yqo02rs8dykkxpm274w3bd",
    { waitUntil: "networkidle2", timeout: 0 }
  );

  // grab raw table rows
  const rows = await page.evaluate(() => {
    const trs = Array.from(document.querySelectorAll("table tbody tr"));
    return trs.map(tr => {
      const tds = Array.from(tr.querySelectorAll("td"));
      return tds.map(td => td.innerText.trim());
    });
  });

  // build HTML table
  let html = "<table>\n";
  rows.forEach(r => {
    html += "  <tr>";
    r.forEach(c => {
      html += `<td>${c}</td>`;
    });
    html += "</tr>\n";
  });
  html += "</table>";

  // save to file
  fs.writeFileSync("goal-table.html", html, "utf-8");

  console.log("✅ Saved goal-table.html");
  await browser.close();
})();
