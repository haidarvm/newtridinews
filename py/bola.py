import requests
from bs4 import BeautifulSoup

url = "https://www.bola.net/klasemen/indonesia.html"
res = requests.get(url)
res.raise_for_status()

soup = BeautifulSoup(res.text, "html.parser")

table = soup.find("table")
rows = table.find_all("tr")

# --- extract header names ---
headers = []
for th in rows[0].find_all("th"):
    if "team" in th.get("class", []):
        headers.append("Team")
    else:
        headers.append(th.get_text(strip=True))

print("Original headers:", headers)

# define order and short labels
wanted_order = ["Team", "Main", "Menang", "Seri", "Kalah", "Poin"]
header_labels = {
    "Team": "Team",
    "Main": "M",
    "Menang": "M",
    "Seri": "S",
    "Kalah": "K",
    "Poin": "P",
}

# get index of each wanted header in original table
wanted_idx = [headers.index(h) for h in wanted_order if h in headers]

# highlight teams (case-insensitive)
highlight = ["persib"]
style = """
<style>
  table {
    border:none;
    border-collapse: collapse;
    width: 100%;
    font-family: Roboto;
    font-size: 16px;
  }
  th, td {
      
    border:none;
    padding: 2px 2px;
    text-align: center;
  }
  td:first-child, td:nth-child(2), th:first-child, th:nth-child(2) {
    text-align: left; /* Pos & Klub rata kiri */
  }
  th {
    background-color: #f2f2f2;
  }
</style>
"""

# --- build new HTML ---
new_html = style +"<table border='1'>\n"
new_html += "  <tr>" + "".join(f"<th>{header_labels[h]}</th>" for h in wanted_order if h in headers) + "</tr>\n"

for row in rows[1:]:
    cols = row.find_all(["td", "th"])
    if not cols:
        continue

    team_text = cols[headers.index("Team")].get_text(strip=True).lower()
    is_highlight = any(name in team_text for name in highlight)

    row_html = "  <tr>"
    for i in wanted_idx:
        text = cols[i].get_text(strip=False)
        if is_highlight:
            row_html += f"<td><b>{text}</b></td>"
        else:
            row_html += f"<td>{text}</td>"
    row_html += "</tr>\n"
    new_html += row_html

new_html += "</table>"

with open("/usr/local/www/republikbobotoh/public/bola_klasemen.html", "w", encoding="utf-8") as f:
    f.write(new_html)

print("✅ Saved to bola_klasemen.html")
