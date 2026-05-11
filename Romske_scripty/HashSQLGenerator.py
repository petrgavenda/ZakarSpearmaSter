import hashlib

# Pokud nemáš pycryptodome:
# pip install pycryptodome
from Crypto.Hash import RIPEMD160

input_file = r"C:\Users\gavenda_petr\Desktop\passwords.txt"

output_combined = r"C:\Users\gavenda_petr\Desktop\import_all_hashes.sql"

# Načtení hesel
with open(input_file, "r", encoding="utf-8") as f:
    passwords = [line.strip() for line in f if line.strip()]

# =========================
# All Hashes Combined
# =========================
with open(output_combined, "w", encoding="utf-8") as sql:
    sql.write("USE password;\n\n")

    for password in passwords:
        md5_hash = hashlib.md5(password.encode()).hexdigest()
        ripemd160 = RIPEMD160.new()
        ripemd160.update(password.encode())
        ripemd160_hash = ripemd160.hexdigest()
        sha256_hash = hashlib.sha256(password.encode()).hexdigest()
        
        escaped = password.replace("'", "''")

        sql.write(
            f"INSERT INTO password (password, hash_md5, hash_ripemd160, hash_sha256) "
            f"VALUES ('{escaped}', '{md5_hash}', '{ripemd160_hash}', '{sha256_hash}');\n"
        )

print("Combined SQL file with all hashes created.")