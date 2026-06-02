import mysql.connector

db_config = {
    'host': 'localhost',        
    'user': 'root',      
    'password': '', 
    'database': 'zakarspearmaster'
}

output_file = 'export_people.sql'

try:
    conn = mysql.connector.connect(**db_config)
    cursor = conn.cursor(dictionary=True)

    sql_query = "SELECT firstname, lastname, born, profile_picture, biography FROM search_people"
    cursor.execute(sql_query)
    rows = cursor.fetchall()

    if rows:
        with open(output_file, 'w', encoding='utf-8') as f:
            f.write("INSERT INTO search_people (firstname, lastname, born, profile_picture, biography) VALUES\n\n")
            
            values_list = []
            for row in rows:
                firstname = str(row.get('firstname') or '').replace("'", "''")
                lastname = str(row.get('lastname') or '').replace("'", "''")
                born = str(row.get('born') or '')
                profile_picture = str(row.get('profile_picture') or '')
                biography = str(row.get('biography') or '').replace("'", "''")
                
                value_str = f"('{firstname}', '{lastname}', '{born}', '{profile_picture}', '{biography}')"
                values_list.append(value_str)
            
            f.write(",\n".join(values_list))
            f.write(";\n")
            
        print(f"Hotovo! {len(rows)} záznamů bylo úspěšně exportováno do {output_file}")
    else:
        print("V tabulce search_people nebyla nalezena žádná data.")

except mysql.connector.Error as err:
    print(f"Chyba při práci s databází: {err}")

finally:
    if 'cursor' in locals() and cursor is not None:
        cursor.close()
    if 'conn' in locals() and conn.is_connected():
        conn.close()