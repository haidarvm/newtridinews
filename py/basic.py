style = """
<style>
  table {
    border:none;
    border-collapse: collapse;
    width: 100%;
    font-family: Arial, sans-serif;
    font-size: 14px;
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

new_html = style +"<table border='1'>\n"

with open("public/bola_klasemen.html", "w", encoding="utf-8") as f:
    f.write(new_html)

print("✅ Saved to bola_klasemen.html")