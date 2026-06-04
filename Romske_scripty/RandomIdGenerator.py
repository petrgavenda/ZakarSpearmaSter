import mysql.connector
import random
import sys

db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'ZakarSpearmaSter' 
}

try:
    print("Připojování k databázi...")
    conn = mysql.connector.connect(**db_config)
    cursor = conn.cursor()

    cursor.execute("SELECT id FROM website")
    websites = [row[0] for row in cursor.fetchall()]
    
    cursor.execute("SELECT id FROM search_people")
    people = [row[0] for row in cursor.fetchall()]
    
    if not websites or not people:
        print("Chyba: Tabulky 'website' nebo 'search_people' jsou prázdné!")
        sys.exit(1)
        
    cursor.execute("SELECT id FROM password WHERE website_id IS NULL OR search_people_id IS NULL")
    passwords = [row[0] for row in cursor.fetchall()]
    
    total_passwords = len(passwords)
    if total_passwords == 0:
        print("Všechna hesla již mají přiřazený web i objevitele. Není co aktualizovat.")
        sys.exit(0)
        
    print(f"Nalezeno {total_passwords} hesel k aktualizaci. Generuji náhodné vazby...")

    update_query = """
        UPDATE password 
        SET website_id = %s, search_people_id = %s 
        WHERE id = %s
    """
    
    update_data = []
    for password_id in passwords:
        random_web = random.choice(websites)
        random_person = random.choice(people)
        update_data.append((random_web, random_person, password_id))

    batch_size = 2000
    print("Zapisuji data do databáze...")
    
    for i in range(0, len(update_data), batch_size):
        batch = update_data[i:i + batch_size]
        cursor.executemany(update_query, batch)
        conn.commit() 
        print(f" -> Aktualizováno {min(i + batch_size, total_passwords)} / {total_passwords}")

    print("\nHOTOTOVO! Všechny záznamy byly úspěšně propojeny.")

except mysql.connector.Error as err:
    print(f"Nastala chyba databáze: {err}")
finally:
    if 'conn' in locals() and conn.is_connected():
        cursor.close()
        conn.close()
        print("Spojení s databází bylo uzavřeno.")