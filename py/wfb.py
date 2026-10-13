import requests
import cloudscraper
from bs4 import BeautifulSoup

def generate_simple_html():
    # URL Musim 2025/2026
    url = "https://www.worldfootball.net/competition/co834/indonesia-liga-1/se97280/2025-2026/results-and-standings/"
    
    try:
        # Menggunakan cloudscraper untuk bypass Cloudflare di FreeBSD
        scraper = cloudscraper.create_scraper(
            delay=10, 
            browser={
                'browser': 'chrome',
                'platform': 'windows',
                'mobile': False
            }
        )
        response = scraper.get(url, timeout=20)
        soup = BeautifulSoup(response.text, 'html.parser')
        
        all_tables = soup.find_all('table')
        if not all_tables:
            print(f"Status Code: {response.status_code}")
            with open("debug_server.html", "w", encoding="utf-8") as f:
                f.write(response.text)
            return

        table = soup.find('table', class_='standard_tabelle')
        if not table:
            table = max(all_tables, key=lambda t: len(t.find_all('tr')))
        
        rows = table.find_all('tr')

        # Header HTML dengan CSS inline sederhana sesuai permintaan
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
                text-align: left;
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
            # Validasi baris data
            if len(cols) < 10 or not cols[0].text.strip().isdigit():
                continue

            # Nama tim diambil dari link agar tidak double
            team_link = cols[2].find('a')
            team_name = team_link.get_text(strip=True) if team_link else cols[2].get_text(strip=True)
            
            # Koreksi Pemetaan Kolom WorldFootball 2025-2026:
            # 0: Pos, 2: Klub, 3: Main(M), 4: Menang(M), 5: Seri(S), 6: Kalah(K), 9: Poin(P)
            pos   = cols[0].text.strip()
            m     = cols[4].text.strip()
            w     = cols[5].text.strip()
            d     = cols[6].text.strip()
            l     = cols[7].text.strip()
            pts   = cols[9].text.strip()

            # Logika Bold untuk Persib
            is_persib = "Persib" in team_name
            start_b = "<b>" if is_persib else ""
            end_b = "</b>" if is_persib else ""

            html_content += f"""
                <tr>
                    <td>{start_b}{pos}{end_b}</td>
                    <td>{start_b}{team_name}{end_b}</td>
                    <td>{start_b}{m}{end_b}</td>
                    <td>{start_b}{w}{end_b}</td>
                    <td>{start_b}{d}{end_b}</td>
                    <td>{start_b}{l}{end_b}</td>
                    <td>{start_b}{pts}{end_b}</td>
                </tr>"""

        html_content += "</tbody></table>"
        
        # Path file tujuan (Silakan pilih salah satu sesuai kebutuhan server)
        fileloc = '/usr/local/www/republikbobotoh/public/klasemen_simple.html'
        
        with open(fileloc, "w", encoding="utf-8") as f:
            f.write(html_content)
        
        print(f"Selesai! File berhasil dibuat di {fileloc}")

    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    generate_simple_html()