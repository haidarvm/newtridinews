import requests
from bs4 import BeautifulSoup

url = "https://sport.detik.com/sepakbola/klasemen/liga-indonesia"

headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64)",
    "Accept-Language": "id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7",
}

res = requests.get(url, headers=headers)
res.raise_for_status()

soup = BeautifulSoup(res.text, "html.parser")

# Ambil semua teks halaman sebagai baris
text = soup.get_text("\n", strip=True)
lines = text.splitlines()

# Cari awal header klasemen
try:
    start_idx = lines.index("Position")
except ValueError:
    # kalau struktur berubah lagi, simpan debug
    with open("detik_debug.txt", "w", encoding="utf-8") as f:
        f.write(text)
    raise SystemExit("Tidak menemukan 'Position', cek detik_debug.txt")

expected_header = ["Position", "Klub", "D", "M", "S", "K", "SG", "Pn", "Hasil"]
header_slice = lines[start_idx:start_idx + len(expected_header)]

# optional: cek apakah header sesuai, kalau tidak, tetap lanjut tapi kasih warning
if header_slice != expected_header:
    print("Warning: header tidak persis sama, tapi tetap mencoba parse...")

i = start_idx + len(expected_header)

rows = []

while i < len(lines):
    line = lines[i].strip()
    if not line:
        i += 1
        continue

    # akhir blok klasemen
    if line.startswith("D:Dimainkan"):
        break

    # kalau bukan angka posisi, skip
    if not line[0].isdigit():
        i += 1
        continue

    # --------- mulai blok satu tim ---------
    pos = lines[i].strip()
    i += 1
    if i >= len(lines): break

    team = lines[i].strip()
    i += 1
    if i + 6 > len(lines): break

    dimainkan = lines[i].strip(); i += 1
    menang    = lines[i].strip(); i += 1
    seri      = lines[i].strip(); i += 1
    kalah     = lines[i].strip(); i += 1
    sg        = lines[i].strip(); i += 1
    poin      = lines[i].strip(); i += 1

    # 5 baris berikut adalah “Hasil” (form terakhir 5 pertandingan)
    if i + 5 > len(lines): break
    hasil5 = lines[i:i+5]
    i += 5

    rows.append({
        "pos": pos,
        "team": team,
        "main": dimainkan,
        "menang": menang,
        "seri": seri,
        "kalah": kalah,
        "sg": sg,
        "poin": poin,
        "hasil": hasil5,
    })

print(f"Parsed {len(rows)} baris klasemen")

# --- Bangun HTML seperti contohmu ---

style = """
<style>
  table {
    border:none;
    border-collapse: collapse;
    width: 100%;
    font-family: Roboto, Arial, sans-serif;
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

html = []
html.append(style)
html.append("<table border='1'>")

# Header persis seperti contoh yang kamu kirim
html.append("<tr><th>Pos</th><th>Team</th><th>M</th><th>M</th><th>S</th><th>K</th><th>P</th></tr>")

for row in rows:
    pos   = row["pos"]
    team  = row["team"]
    
    rename_map = {
        "BHAYANGKARA PRESISI LAMPUNG FC": "Bhayangkara FC",
        "Borneo FC Samarinda": "Borneo ",
        "Dewa United Banten FC": "Dewa United",
        "Persija Jakarta": "Persija",
        "Madura United FC": "Madura United",
        "PERSEBAYA Surabaya": "Persebaya",
    }
    team  = rename_map.get(team,team)
    main  = row["main"]
    menang = row["menang"]
    seri  = row["seri"]
    kalah = row["kalah"]
    poin  = row["poin"]

    # kalau mau bold PERSIB seperti contoh lama, bisa aktifkan ini:
    is_persib = "PERSIB" in team.upper()

    if is_persib:
        html.append(
            "<tr>"
            f"<td><b>{pos}</b></td>"
            f"<td><b>{team}</b></td>"
            f"<td><b>{main}</b></td>"
            f"<td><b>{menang}</b></td>"
            f"<td><b>{seri}</b></td>"
            f"<td><b>{kalah}</b></td>"
            f"<td><b>{poin}</b></td>"
            "</tr>"
        )
    else:
        html.append(
            "<tr>"
            f"<td>{pos}</td>"
            f"<td>{team}</td>"
            f"<td>{main}</td>"
            f"<td>{menang}</td>"
            f"<td>{seri}</td>"
            f"<td>{kalah}</td>"
            f"<td>{poin}</td>"
            "</tr>"
        )

html.append("</table>")

final_html = "\n".join(html)

with open("/usr/local/www/republikbobotoh/public/detik_klasmen.html", "w", encoding="utf-8") as f:
    f.write(final_html)

print("Saved detik_klasmen.html")
