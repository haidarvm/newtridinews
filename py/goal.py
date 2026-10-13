import requests
from bs4 import BeautifulSoup

def get_klasemen():
    url = "https://www.goal.com/id/super-league/tabel/117yqo02rs8dykkxpm274w3bd"
    headers = {
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
    }

    try:
        response = requests.get(url, headers=headers)
        response.raise_for_status()
        soup = BeautifulSoup(response.text, 'html.parser')

        # Mencari tabel klasemen
        # Berdasarkan struktur Goal.com, biasanya menggunakan class yang spesifik
        table = soup.find('table')
        rows = table.find_all('tr')

        print(f"{'Pos':<4} | {'Tim':<25} | {'M':<3} | {'Poin':<4}")
        print("-" * 45)

        for row in rows[1:]:  # Skip header
            cols = row.find_all('td')
            if len(cols) < 2:
                continue

            # Ekstrak data (indeks mungkin berubah sesuai update UI web)
            pos = cols[0].text.strip()
            # Nama tim biasanya ada di dalam span atau elemen dengan class tertentu
            team_name = cols[1].find('span', class_='p-c-table__team-name-full').text.strip()
            played = cols[3].text.strip()
            points = cols[9].text.strip()

            data_str = f"{pos:<4} | {team_name:<25} | {played:<3} | {points:<4}"

            # Logika Bold untuk Persib
            if "Persib" in team_name:
                # Menggunakan ANSI escape code untuk bold di terminal
                print(f"\033[1m{data_str} <-- JUARA!\033[0m")
            else:
                print(data_str)

    except Exception as e:
        print(f"Terjadi kesalahan: {e}")

if __name__ == "__main__":
    get_klasemen()