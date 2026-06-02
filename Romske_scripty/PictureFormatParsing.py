import mysql.connector

# 1. Konfigurace připojení k databázi
db_config = {
    'host': 'localhost',        
    'user': 'root',      
    'password': '',  
    'database': 'zakarspearmaster'
}

try:
    conn = mysql.connector.connect(**db_config)
    cursor = conn.cursor()

    sql_query = """
        UPDATE search_people 
        SET profile_picture = CONCAT(LOWER(firstname), '_', LOWER(lastname), '.jpg')
        WHERE firstname IS NOT NULL AND lastname IS NOT NULL;
    """

    cursor.execute(sql_query)
    conn.commit()

    print(f"Hotovo! Bylo úspěšně aktualizováno {cursor.rowcount} záznamů.")

except mysql.connector.Error as err:
    print(f"Chyba při práci s databází: {err}")

finally:
    if 'cursor' in locals() and cursor is not None:
        cursor.close()
    if 'conn' in locals() and conn.is_connected():
        conn.close()
        print("Připojení k databázi bylo bezpečně uzavřeno.")