import requests
from bs4 import BeautifulSoup

def generate_simple_html():
    # URL ileague.id untuk BRI Super League 2025-26
    url = "https://ileague.id/table/index/BRI_SUPER_LEAGUE_2026-27"
    headers = {
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
    }

    try:
        print("Mengambil data dari ileague.id...")
        response = requests.get(url, headers=headers, timeout=20)
        response.raise_for_status()
        soup = BeautifulSoup(response.text, 'html.parser')
        
        # Mencari tabel - ileague biasanya menggunakan class 'table'
        table = soup.find('table')
        if not table:
            print("Gagal menemukan tabel di ileague.id.")
            return

        rows = table.find_all('tr')

        html_content = """
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
                padding: 5px 2px;
                text-align: center;
            }
            td:first-child, td:nth-child(2), th:first-child, th:nth-child(2) {
                text-align: left; /* Pos & Klub rata kiri */
            }
            th {
                background-color: #f2f2f2;
            }
            </style>
            <table>
                <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Klub</th>
                        <th>M</th>
                        <th>M</th>
                        <th>S</th>
                        <th>K</th>
                        <th>P</th>
                    </tr>
                </thead>
                <tbody>
        """

        for row in rows:
            cols = row.find_all(['td', 'th'])
            # Abaikan baris header atau baris kosong
            if len(cols) < 7 or not cols[0].text.strip().isdigit():
                continue

            # ileague structure: 0:Rank, 1:Club, 2:P(Main), 3:W, 4:D, 5:L, 6:GF, 7:GA, 8:GD, 9:Pts
            pos   = cols[0].get_text(strip=True)
            team  = cols[1].get_text(strip=True)
            m     = cols[2].get_text(strip=True) # Played
            w     = cols[3].get_text(strip=True) # Won
            d     = cols[4].get_text(strip=True) # Draw
            l     = cols[5].get_text(strip=True) # Lost
            pts   = cols[9].get_text(strip=True) # Points

            # Logika Bold untuk Persib
            is_persib = "PERSIB BANDUNG" in team
            start_b = "<b>" if is_persib else ""
            end_b = "</b>" if is_persib else ""

            html_content += f"""
                <tr>
                    <td>{start_b}{pos}{end_b}</td>
                    <td>{start_b}{team}{end_b}</td>
                    <td>{start_b}{m}{end_b}</td>
                    <td>{start_b}{w}{end_b}</td>
                    <td>{start_b}{d}{end_b}</td>
                    <td>{start_b}{l}{end_b}</td>
                    <td>{start_b}{pts}{end_b}</td>
                </tr>"""

        html_content += "</tbody></table>"
        
        # Lokasi file di server Anda
        fileloc = '/mnt/data/public_html/republikbobotoh/public/klasemen_simple.html'
        
        with open(fileloc, "w", encoding="utf-8") as f:
            f.write(html_content)
        
        print(f"Selesai! File berhasil dibuat di {fileloc}")

    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    generate_simple_html()